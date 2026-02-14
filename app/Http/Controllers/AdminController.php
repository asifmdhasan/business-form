<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Mold;
use App\Models\User;
use App\Models\Variant;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Warehouse;
use App\Models\FtpSetting;
use App\Models\Requisition;
use App\Models\Notification;
use App\Models\UploadedFile;
use Illuminate\Http\Request;
use App\Models\WarehouseStock;
use Illuminate\Support\Carbon;
use App\Models\GmeBusinessForm;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Thresholds;

class AdminController extends Controller
{


    public function index(Request $request)
    {
        $user = auth()->user(); // Logged-in user

        if ($user->username == 'superadmin') {
            // Admin or superadmin - see all files
            $files = UploadedFile::with('user')->latest()->get();
        } else {
            // Normal user - only see own files
            $files = UploadedFile::with('user')
                ->where('user_id', $user->id)
                ->latest()
                ->get();
        }

        return view('admin.files.index', compact('files'));
    }

    public function edit(UploadedFile $file)
    {
        return view('admin.files.edit', compact('file'));
    }

    public function allFiles(Request $request)
    {
        return view('admin.files.allfiles');
    }

    public function update(Request $request, UploadedFile $file)
    {
        $request->validate([
            'file_name' => 'required|string|max:255',
        ]);

        $file->update([
            'file_name' => $request->file_name,
        ]);

        // return redirect()->route('files.edit', $file)->with('success', 'File updated successfully!');
        return redirect()->route('files.index', $file)->with('success',  __('layouts.updated_successfully'));
    }

    public function dashboard(Request $request)
    {

        // $totalCustomers = Customer::where('status', 1)->where('is_otp_verified', 1)->count();
        $totalBusinesses = GmeBusinessForm::where('status', '!=', 'draft')->count();
        $totalPendingBusinesses = GmeBusinessForm::where('status', 'pending')->count();
        $approvedBusinesses = GmeBusinessForm::where('status', 'approved')->count();
        $requestForDeleteBusinesses = GmeBusinessForm::where('status', 'request_for_delete')->count();



        return view('admin.dashboard', compact(
            'totalBusinesses',
            'totalPendingBusinesses',
            // 'totalCustomers',
            'approvedBusinesses',
            'requestForDeleteBusinesses'
        ));
    }

}
