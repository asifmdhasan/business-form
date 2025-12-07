<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\LoginAuthMiddleware;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\GmeBusinessController;
use App\Http\Controllers\FrontendGmeBusinessController;


Route::middleware(['web', 'setLocale'])->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/make-hash/{string}', function ($string) {
    return response()->json([
        'original' => $string,
        'hash' => bcrypt($string),
    ]);
});

Route::middleware([
    'setLocale',
    LoginAuthMiddleware::class,
])->group(function () {

    // Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');
    // Route::get('/gme-business/create', [GmeBusinessController::class, 'create'])->name('gme-business.create');
    // Route::post('/gme-business/store', [GmeBusinessController::class, 'store'])->name('gme-business.store');
    // Route::get('/gme-business', [GmeBusinessController::class, 'index'])->name('gme-business.index');

    Route::resource('gme-business', FrontendGmeBusinessController::class);

    Route::resource('gme-business-admin', GmeBusinessController::class);




    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.list');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
    });

    Route::group(['prefix' => 'reports'], function () {
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('reports.analytics');
        Route::get('/export-csv', [AnalyticsController::class, 'exportCsv'])->name('reports.export.csv');
        Route::get('/export-xlsx', [AnalyticsController::class, 'exportXlsx'])->name('reports.export.xlsx');
        Route::get('/export-pdf', [AnalyticsController::class, 'exportPdf'])->name('reports.export.pdf');

        // Route::get('/analytics', [AnalyticsController::class, 'index'])->name('reports.index');
        Route::get('/data', [AnalyticsController::class, 'fetchData'])->name('reports.data');
    });


    Route::get('/notifications/latest', [AdminController::class, 'latestNotifications']);
    Route::post('/notifications/read/{id}', [AdminController::class, 'markAsRead']);

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Route::get('/dashboard/chart-data', [AdminController::class, 'dashboard'])->name('admin.dashboard.chartData');
    Route::get('/admin/dashboard/chart-data', [AdminController::class, 'chartData'])->name('admin.dashboard.chartData');

    Route::get('/stock-entry-chart', [AdminController::class, 'stockEntryChart'])
        ->name('dashboard.stockEntryChart');

    Route::get('/stock-out-chart', [AdminController::class, 'stockOutChart'])
        ->name('dashboard.stockOutChart');

    Route::get('/stock-in-out-chart', [AdminController::class, 'stockInOutChart'])
        ->name('dashboard.stockInOutChart');

    Route::get('/purchase-and-requisition-chart', [AdminController::class, 'purchaseRequisitionChart'])
        ->name('dashboard.purchaseRequisitionChart');




    
    Route::group(['prefix' => 'user'], function () {

        // Route::resource('user', UserController::class);
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update/{user}', [UserController::class, 'update'])->name('user.update');
        // Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');

        // Route::get('settings', [UserController::class, 'userSettings'])->name('users.settings');
        Route::post('store/settings', [UserController::class, 'updateUserSettings'])->name('user.store-settings');
        Route::get('profile/update', [UserController::class, 'userProfileUpdate'])->name('user.profileUpdate');
        Route::post('profile/update', [UserController::class, 'storeUserProfileUpdate'])->name('user.profileUpdate');

        Route::get('/change-password', [UserController::class, 'changePassword'])->name('user.changePassword');
        Route::post('/change-password', [UserController::class, 'storeChangePassword'])->name('user.changePassword');
        Route::get('/settings', [UserController::class, 'userSettings'])->name('user.settings');
    });




});