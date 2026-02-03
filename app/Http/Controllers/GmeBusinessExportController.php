<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GmeBusinessForm;
use Illuminate\Support\Facades\DB;

class GmeBusinessExportController extends Controller
{
    public function exportAllPage()
    {
        $totalCount = GmeBusinessForm::where('status', '!=', 'draft')->count();
        $pendingCount = GmeBusinessForm::where('status', 'pending')->count();
        $approvedCount = GmeBusinessForm::where('status', 'approved')->count();
        $rejectedCount = GmeBusinessForm::where('status', 'rejected')->count();
        
        $businesses = GmeBusinessForm::with('category')
            ->where('status', '!=', 'draft')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
        
        return view('gme-business-admin.export-all', compact(
            'totalCount',
            'pendingCount', 
            'approvedCount', 
            'rejectedCount',
            'businesses'
        ));
    }
    
    /**
     * Export All (except draft) - Download CSV
     */
    public function exportAll()
    {
        $businesses = GmeBusinessForm::with(['category:id,name'])
            ->where('status', '!=', 'draft')
            ->orderBy('id', 'desc')
            ->get();

        return $this->downloadCSV($businesses, 'all_businesses');
    }
    
    /**
     * Show Export Pending Page
     */
    public function exportPendingPage()
    {
        $pendingCount = GmeBusinessForm::where('status', 'pending')->count();
        
        $recentCount = GmeBusinessForm::where('status', 'pending')
            ->where('created_at', '>=', now()->subDays(7))
            ->count();
        
        $categoriesCount = GmeBusinessForm::where('status', 'pending')
            ->distinct('business_category_id')
            ->count('business_category_id');
        
        // Count unique countries
        $businesses = GmeBusinessForm::where('status', 'pending')
            ->whereNotNull('countries_of_operation')
            ->get();
        
        $uniqueCountries = [];
        foreach ($businesses as $business) {
            if ($business->countries_of_operation) {
                $countries = is_array($business->countries_of_operation) 
                    ? $business->countries_of_operation 
                    : json_decode($business->countries_of_operation, true) ?? [];
                $uniqueCountries = array_merge($uniqueCountries, $countries);
            }
        }
        $countriesCount = count(array_unique($uniqueCountries));
        
        $businesses = GmeBusinessForm::with('category')
            ->where('status', 'pending')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
        
        return view('gme-business-admin.export-pending', compact(
            'pendingCount',
            'recentCount',
            'categoriesCount',
            'countriesCount',
            'businesses'
        ));
    }

    /**
     * Export Pending only - Download CSV
     */
    public function exportPending()
    {
        $businesses = GmeBusinessForm::with(['category:id,name'])
            ->where('status', 'pending')
            ->orderBy('id', 'desc')
            ->get();

        return $this->downloadCSV($businesses, 'pending_businesses');
    }

    /**
     * Show Export Approved Page
     */
    public function exportApprovedPage()
    {
        $approvedCount = GmeBusinessForm::where('status', 'approved')->count();
        
        $recentlyApprovedCount = GmeBusinessForm::where('status', 'approved')
            ->where('updated_at', '>=', now()->subDays(30))
            ->count();
        
        $categoriesCount = GmeBusinessForm::where('status', 'approved')
            ->distinct('business_category_id')
            ->count('business_category_id');
        
        // Count unique countries
        $businesses = GmeBusinessForm::where('status', 'approved')
            ->whereNotNull('countries_of_operation')
            ->get();
        
        $uniqueCountries = [];
        foreach ($businesses as $business) {
            if ($business->countries_of_operation) {
                $countries = is_array($business->countries_of_operation) 
                    ? $business->countries_of_operation 
                    : json_decode($business->countries_of_operation, true) ?? [];
                $uniqueCountries = array_merge($uniqueCountries, $countries);
            }
        }
        $countriesCount = count(array_unique($uniqueCountries));
        
        $businesses = GmeBusinessForm::with('category')
            ->where('status', 'approved')
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();
        
        // Top Categories
        $topCategories = GmeBusinessForm::where('status', 'approved')
            ->select('business_category_id', DB::raw('count(*) as businesses_count'))
            ->with('category:id,name')
            ->groupBy('business_category_id')
            ->orderBy('businesses_count', 'desc')
            ->limit(5)
            ->get()
            ->map(function($item) {
                return (object)[
                    'name' => $item->category->name ?? 'Uncategorized',
                    'businesses_count' => $item->businesses_count
                ];
            });
        
        // Top Countries
        $allBusinesses = GmeBusinessForm::where('status', 'approved')
            ->whereNotNull('countries_of_operation')
            ->get();
        
        $countryCounts = [];
        foreach ($allBusinesses as $business) {
            if ($business->countries_of_operation) {
                $countries = is_array($business->countries_of_operation) 
                    ? $business->countries_of_operation 
                    : json_decode($business->countries_of_operation, true) ?? [];
                
                foreach ($countries as $country) {
                    if (!isset($countryCounts[$country])) {
                        $countryCounts[$country] = 0;
                    }
                    $countryCounts[$country]++;
                }
            }
        }
        
        arsort($countryCounts);
        $topCountries = array_slice(array_map(function($country, $count) {
            return ['country' => $country, 'count' => $count];
        }, array_keys($countryCounts), $countryCounts), 0, 5);
        
        return view('gme-business-admin.export-approved', compact(
            'approvedCount',
            'recentlyApprovedCount',
            'categoriesCount',
            'countriesCount',
            'businesses',
            'topCategories',
            'topCountries'
        ));
    }

    /**
     * Export Approved only - Download CSV
     */
    public function exportApproved()
    {
        $businesses = GmeBusinessForm::with(['category:id,name'])
            ->where('status', 'approved')
            ->orderBy('id', 'desc')
            ->get();

        return $this->downloadCSV($businesses, 'approved_businesses');
    }

    /**
     * Generate and download CSV
     */
    private function downloadCSV($businesses, $filename)
    {
        $fileName = $filename . '_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($businesses) {
            $file = fopen('php://output', 'w');

            // CSV Headers
            fputcsv($file, [
                'ID',
                'Business Name',
                'Category',
                'Status',
                'Year Established',
                'Countries of Operation',
                'Business Address',
                'Email',
                'WhatsApp Number',
                'Website',
                'Facebook',
                'Instagram',
                'LinkedIn',
                'YouTube',
                'Online Store',
                'Registration Status',
                'Employee Count',
                'Operational Scale',
                'Annual Revenue',
                'Short Introduction',
                'Business Overview',
                'Ethical Description',
                'Avoid Riba',
                'Avoid Haram Products',
                'Fair Pricing',
                'Open for Guidance',
                'Collaboration Open',
                'Collaboration Types',
                'Allow Publish',
                'Allow Contact',
                'Created At',
                'Updated At'
            ]);

            // CSV Rows
            foreach ($businesses as $business) {
                fputcsv($file, [
                    $business->id,
                    $business->business_name ?? '-',
                    $business->category->name ?? '-',
                    ucfirst($business->status),
                    $business->year_established ?? '-',
                    $this->formatJsonArray($business->countries_of_operation),
                    $business->business_address ?? '-',
                    $business->email ?? '-',
                    $business->whatsapp_number ?? '-',
                    $business->website ?? '-',
                    $business->facebook ?? '-',
                    $business->instagram ?? '-',
                    $business->linkedin ?? '-',
                    $business->youtube ?? '-',
                    $business->online_store ?? '-',
                    $business->registration_status ?? '-',
                    $business->employee_count ?? '-',
                    $business->operational_scale ?? '-',
                    $business->annual_revenue ?? '-',
                    $business->short_introduction ?? '-',
                    $business->business_overview ?? '-',
                    $business->ethical_description ?? '-',
                    $business->avoid_riba ?? '-',
                    $business->avoid_haram_products ?? '-',
                    $business->fair_pricing ?? '-',
                    $business->open_for_guidance ?? '-',
                    $business->collaboration_open ?? '-',
                    $this->formatJsonArray($business->collaboration_types),
                    $business->allow_publish ? 'Yes' : 'No',
                    $business->allow_contact ? 'Yes' : 'No',
                    $business->created_at->format('Y-m-d H:i:s'),
                    $business->updated_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Format JSON array to string
     */
    private function formatJsonArray($jsonData)
    {
        if (!$jsonData) return '-';
        
        try {
            $parsed = is_string($jsonData) ? json_decode($jsonData, true) : $jsonData;
            return is_array($parsed) ? implode(', ', $parsed) : '-';
        } catch (\Exception $e) {
            return '-';
        }
    }
}
