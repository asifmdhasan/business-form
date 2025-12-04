<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Mold;
use App\Models\Part;
use App\Models\Variant;
use App\Models\Purchase;
use App\Models\Transfer;
use App\Models\Requisition;
use Illuminate\Http\Request;
use App\Models\StockTransaction;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        return view('reports.analytics');
    }

    public function fetchData(Request $request)
    {
        $type = $request->get('type', 'parts');
        $startDate = Carbon::parse($request->get('start_date'))->startOfDay();
        $endDate   = Carbon::parse($request->get('end_date'))->endOfDay();

        $query = null;

        switch ($type) {
            case 'stock_in':
                $query = StockTransaction::with(['variant', 'user', 'store_location'])
                        ->where('activity_type', 'IN')
                        ->whereBetween('created_at', [$startDate, $endDate]);
                $columns = ['id', 'part_name', 'variant_value', 'quantity', 'user_name', 'store_location', 'created_at'];
                $headers = [
                    'part_name' => __('layouts.part_name'),
                    'variant_value' => __('layouts.variant'),
                    'quantity' => __('layouts.quantity'),
                    'user_name' => __('layouts.created_by'),
                    'store_location' => __('layouts.store_location'),
                    'created_at' => __('layouts.created_at'),
                ];

                $data = $query->get()->map(function($transaction) {
                    return [
                        'id' => $transaction->id,
                        'part_name' => $transaction->variant->part->part_name ?? '',
                        'variant_value' => $transaction->variant->value ?? '',
                        'quantity' => $transaction->quantity,
                        'user_name' => $transaction->user->name ?? '',
                        'store_location' => $transaction->store_location->title ?? '',
                        'created_at' => $transaction->created_at->format('Y-m-d H:i:s'),
                    ];
                });

                break;

            case 'stock_out':
                $query = StockTransaction::with(['variant', 'user', 'store_location'])
                        ->where('activity_type', 'OUT')
                        ->whereBetween('created_at', [$startDate, $endDate]);
                $columns = ['id', 'part_name', 'variant_value', 'quantity', 'user_name', 'store_location', 'created_at'];
                $headers = [
                    'part_name' => __('layouts.part_name'),
                    'variant_value' => __('layouts.variant'),
                    'quantity' => __('layouts.quantity'),
                    'user_name' => __('layouts.created_by'),
                    'store_location' => __('layouts.store_location'),
                    'created_at' => __('layouts.created_at'),
                ];

                $data = $query->get()->map(function($transaction) {
                    return [
                        'id' => $transaction->id,
                        'part_name' => $transaction->variant->part->part_name ?? '',
                        'variant_value' => $transaction->variant->value ?? '',
                        'quantity' => $transaction->quantity,
                        'user_name' => $transaction->user->name ?? '',
                        'store_location' => $transaction->store_location->title ?? '',
                        'created_at' => $transaction->created_at->format('Y-m-d H:i:s'),
                    ];
                });

                break;

            case 'purchases':
                $query = Purchase::with('details.approvedUser', 'details.part', 'details.variant', 'dealer', 'user')
                    ->where('status', 'approved')
                    ->whereBetween('created_at', [$startDate, $endDate]);

                $columns = ['id', 'created_by', 'dealer_name', 'total_amount', 'part', 'quantity', 'approved_by', 'created_at'];
                $headers = [
                    'created_by' => __('layouts.created_by'),
                    'dealer_name' => __('layouts.dealer_name'),
                    'total_amount' => __('layouts.total_amount'),
                    'part' => __('layouts.part'),
                    'quantity' => __('layouts.quantity'),
                    'approved_by' => __('layouts.approved_by'),
                    'created_at' => __('layouts.created_at'),
                ];

                $data = $query->get()->map(function($purchase) {
                    return [
                        'id' => $purchase->id,
                        'created_by' => $purchase->user->name,
                        'dealer_name' => $purchase->dealer->name ?? '',
                        'total_amount' => $purchase->total_amount,
                        'part' => $purchase->details
                            ->map(fn($d) => ($d->part->part_name ?? '') . ' (' . ($d->variant->value ?? '') . ')')
                            ->implode(', '),
                        // 'quantity' => $purchase->details->sum('qc_passed_quantity'),
                        'quantity' => $purchase->details
                            ->map(fn($d) => $d->qc_passed_quantity)
                            ->implode(', '),
                        'approved_by' => $purchase->details->map(fn($d) => $d->approvedUser->name ?? '')->implode(', '),
                        'created_at' => $purchase->created_at->format('Y-m-d H:i:s'),
                    ];
                });

                break;

            case 'requisitions':
                $query = Requisition::with([
                    'user', 
                    'approved_by', 
                    'requisition_details.part', 
                    'requisition_details.variant', 
                    'requisition_details.storeLocation',
                    'requisition_details.storeLocations'
                ])
                ->where('status', 'approved')
                ->whereBetween('created_at', [$startDate, $endDate]);

                $columns = ['id', 'created_by', 'parts', 'quantities', 'store_locations', 'approved_by', 'created_at'];
                $headers = [
                    'created_by' => __('layouts.created_by'),
                    'parts' => __('layouts.part'),
                    'quantities' => __('layouts.quantity'),
                    'store_locations' => __('layouts.store_location'),
                    'approved_by' => __('layouts.approved_by'),
                    'created_at' => __('layouts.created_at'),
                ];

                $data = $query->get()->map(function($requisition) {
                    return [
                        'id' => $requisition->id,
                        'created_by' => $requisition->user->name ?? '',
                        'parts' => $requisition->requisition_details
                                    ->map(fn($d) => ($d->part->part_name ?? '') . ' (' . ($d->variant->value ?? '') . ')')
                                    ->implode(', '),
                        'quantities' => $requisition->requisition_details
                                    ->map(fn($d) => $d->quantity)
                                    ->implode(', '),
                        'store_locations' => $requisition->requisition_details
                                    ->map(function($d) {
                                        $locations = $d->storeLocations->pluck('title')->toArray();
                                        return count($locations) ? implode(', ', $locations) : 'Not Assigned';
                                    })
                                    ->implode(', '), // separate by requisition detail
                        'approved_by' => $requisition->approved_by->name ?? '',
                        'created_at' => $requisition->created_at->format('Y-m-d H:i:s'),
                    ];
                });

                break;

            case 'transfers':
                $query = Transfer::with([
                    'variant',
                    'part',
                    'fromWarehouse',
                    'toWarehouse',
                    'creator',
                    'approver'
                ])->whereBetween('created_at', [$startDate, $endDate]);

                $columns = [
                    'id',
                    'part_name',
                    'variant_value',
                    'from_warehouse',
                    'to_warehouse',
                    'quantity',
                    'created_by',
                    // 'approved_by',
                    'created_at',
                ];

                $headers = [
                    'part_name' => __('layouts.part_name'),
                    'variant_value' => __('layouts.variant'),
                    'from_warehouse' => __('layouts.from_warehouse'),
                    'to_warehouse' => __('layouts.to_warehouse'),
                    'quantity' => __('layouts.quantity'),
                    'created_by' => __('layouts.created_by'),
                    // 'approved_by' => __('layouts.approved_by'),
                    'created_at' => __('layouts.created_at'),
                ];

                $data = $query->get()->map(function($transfer) {
                    return [
                        'id' => $transfer->id,
                        'part_name' => $transfer->part->part_name ?? '',
                        'variant_value' => $transfer->variant->value ?? '',
                        'from_warehouse' => $transfer->fromWarehouse->name ?? '',
                        'to_warehouse' => $transfer->toWarehouse->name ?? '',
                        'quantity' => $transfer->transfer_quantity,
                        'created_by' => $transfer->creator->name ?? '',
                        // 'approved_by' => $transfer->approver->name ?? '',
                        'created_at' => $transfer->created_at->format('Y-m-d H:i:s'),
                    ];
                });
                break;


            case 'molds':
                $query = Mold::whereBetween('created_at', [$startDate, $endDate]);

                $columns = [
                    'id',
                    'name',
                    'number',
                    'model',
                    'created_at',
                ];

                $headers = [
                    'name' => __('layouts.name'),
                    'number' => __('layouts.number'),
                    'model' => __('layouts.model'),
                    'created_at' => __('layouts.created_at'),
                ];

                $data = $query->get()->map(function($mold) {
                    return [
                        'id' => $mold->id,
                        'name' => $mold->name ?? '',
                        'number' => $mold->number ?? '',
                        'model' => $mold->model ?? '-',
                        'created_at' => $mold->created_at->format('Y-m-d H:i:s'),
                    ];
                });
                break;

            default: // parts
                $query = Variant::with(['part', 'attribute', 'warehouseStocks'])
                    ->whereHas('part', function($q) use ($startDate, $endDate) {
                        $q->whereBetween('created_at', [$startDate, $endDate]);
                    });

                $columns = [
                    'id',                   
                    'part_name',            
                    'variant_value',        
                    'attribute_name',       
                    'quantity',             
                    'created_at',           
                ];

                $headers = [
                    'part_name'      => __('layouts.part_name'),
                    'variant_value'  => __('layouts.variant'),
                    'attribute_name' => __('layouts.attribute'),
                    'quantity'       => __('layouts.quantity'),
                    'created_at'     => __('layouts.created_at'),
                ];


                // fetch data and map relational fields
                $data = $query->get()->map(function($variant) {
                    $quantity = $variant->warehouseStocks->isEmpty()
                        ? 'Not assigned'
                        : $variant->warehouseStocks->sum('stock');

                    return [
                        'id' => $variant->id,
                        'part_name' => $variant->part->part_name ?? '',
                        'variant_value' => $variant->value,
                        'attribute_name' => $variant->attribute->name ?? '',
                        'quantity' => $quantity,
                        'created_at' => $variant->created_at->format('Y-m-d H:i:s'),
                    ];
                });

                break;

        }

        return response()->json([
            'columns' => $columns,
            'headers' => $headers, 
            'data' => $data,
            'type' => $type
        ]);
    }

    // Export CSV
    public function exportCsv(Request $request)
    {
        $filename = "report_" . now()->format('Y-m-d_H-i-s') . ".csv";
        $data = [
            ['Stock In', 'Stock Out', 'Purchases', 'Requisitions', 'Transfers', 'Parts', 'Active Parts', 'Molds', 'Active Molds'],
            [
                $request->stockIn,
                $request->stockOut,
                $request->purchases,
                $request->requisitions,
                $request->transfers,
                $request->parts,
                $request->activeParts,
                $request->molds,
                $request->activeMolds
            ],
        ];

        $handle = fopen('php://memory', 'w');
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }
        fseek($handle, 0);

        return response()->streamDownload(function () use ($handle) {
            fpassthru($handle);
        }, $filename);
    }

    // Export XLS (custom XML format for Excel)
    public function exportXlsx(Request $request)
    {
        $filename = "report_" . now()->format('Y-m-d_H-i-s') . ".xls";

        $headers = [
            "Content-Type" => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
        ];

        $data = [
            ['Stock In', 'Stock Out', 'Purchases', 'Requisitions', 'Transfers', 'Parts', 'Active Parts', 'Molds', 'Active Molds'],
            [
                $request->stockIn,
                $request->stockOut,
                $request->purchases,
                $request->requisitions,
                $request->transfers,
                $request->parts,
                $request->activeParts,
                $request->molds,
                $request->activeMolds
            ],
        ];

        // Build XML Spreadsheet
        $xml = '<?xml version="1.0"?>
            <Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
                      xmlns:o="urn:schemas-microsoft-com:office:office"
                      xmlns:x="urn:schemas-microsoft-com:office:excel"
                      xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">
            <Worksheet ss:Name="Report">
                <Table>';

        foreach ($data as $row) {
            $xml .= "<Row>";
            foreach ($row as $cell) {
                $xml .= "<Cell><Data ss:Type=\"String\">$cell</Data></Cell>";
            }
            $xml .= "</Row>";
        }

        $xml .= '</Table></Worksheet></Workbook>';

        return response($xml, 200, $headers);
    }

    // Export PDF
    public function exportPdf(Request $request)
    {
        $pdf = PDF::loadView('reports.export-pdf', $request->all());
        return $pdf->download("report_" . now()->format('Y-m-d_H-i-s') . ".pdf");
    }
}
