<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessCategoryController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendGmeBusinessController;
use App\Http\Controllers\GmeBusinessAdminController;
use App\Http\Controllers\GmeBusinessController;
use App\Http\Controllers\GmeBusinessExportController;
use App\Http\Controllers\GmeRegController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CustomerAuth;
use App\Http\Middleware\LoginAuthMiddleware;
use Illuminate\Support\Facades\Route;













// Route::prefix('gme')->name('gme.')->group(function () {
//     Route::get('/business/register', [GmeBusinessController::class, 'showRegister'])->name('business.register');
//     Route::post('/business/save-step', [GmeBusinessController::class, 'saveStep'])->name('business.save-step');
//     Route::get('/business/success', [GmeBusinessController::class, 'success'])->name('business.success');
// });












Route::middleware(['web', 'setLocale'])->group(function () {
    Route::get('/', [GuestController::class, 'landingPage']);

    // Route::get('/gme-guest/business/register', [GuestController::class, 'showRegisterForm'])->name('gme.business.register.guest');
    // Route::post('/gme-guest/business/save-step', [GuestController::class, 'saveStep'])->name('gme.business.save-step.guest');
    // Route::get('/gme-guest/business/complete-submission', [GuestController::class, 'completeSubmission'])->name('gme.business.complete-submission');
    // Route::get('/gme-guest/business/success', [GuestController::class, 'formSuccess'])->name('gme.business.success.guest');
    // Route::get('/gme-guest-get-services/{categoryId}', [GuestController::class, 'getServices']);


    Route::get('/business/register/form', [GuestController::class, 'guestForm'])->name('guest.form');
    Route::post('/business/register/save-step', [GuestController::class, 'guestSaveStep'])->name('guest.save-step');
    Route::get('/gme-guest/business/success', [GuestController::class, 'formSuccess'])->name('guest.success');
    Route::get('/gme-guest-get-services/{categoryId}', [GuestController::class, 'getServices']);

    //Index
    Route::get('/', [GuestController::class, 'guestIndex'])->name('guest.index');

    Route::get('/guest-gme-businesses', [GuestController::class, 'indexAjax'])->name('guest.gme-business.ajax');
    // Route::get('/guest-gme-featured-businesses', [GuestController::class, 'featuredBusinessAjax'])->name('guest.gme-featured-business.ajax');
        // get category ajax
    Route::get('/guest-get-category', [GuestController::class, 'getCategoryAjax'])->name('guest.get-category.ajax');
        //get Location Ajax
    Route::get('/guest-get-locations', [GuestController::class, 'getLocationAjax'])->name('guest.get-locations.ajax');



    //View GME Business Details
    Route::get('/guest-gme-business-form/{business}', [GuestController::class, 'show'])->name('guest.gme-business-form.show');
    Route::get('/gme-business-form/{business}', [CustomerController::class, 'show'])->name('customer.gme-business-form.show');
    Route::post('/contact-request/submit', [ContactRequestController::class, 'submitContact'])->name('contact.request.submit');





    Route::get('/ad-backdoor', [AuthController::class, 'showLoginForm']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route for log
Route::get('/show-log', function () {
    $logPath = storage_path('logs/laravel.log');
    if (!file_exists($logPath)) {
        abort(404, 'Log file not found.');
    }
    return response()->file($logPath, [
        'Content-Type' => 'text/plain'
    ]);
});


Route::middleware(['setLocale'])->group(function () {
    Route::get('/gme-network-login', [CustomerAuthController::class, 'showCustomerLoginForm'])->name('customer.login');
    Route::post('/gme-network-login', [CustomerAuthController::class, 'cusLogin'])->name('customer.login.submit');
    Route::get('/gme-network-register', function () { return view('customer.auth.register');})->name('customer.register');
    Route::post('/register', [CustomerAuthController::class, 'register']);

    Route::get('/gme-network-verify-otp-form/{customer}', function ($customerId) {
        return view('customer.auth.verify-reg-otp', compact('customerId'));
    })->name('customer.reg.otp.form');

    Route::post('/verify-reg-otp', [CustomerAuthController::class, 'verifyRegOtp'])->name('customer.reg.otp.verify');


    //customer.forget.password.post
    Route::get('/gme-network-forget-password', [CustomerAuthController::class, 'showForgetPasswordForm'])->name('customer.forget.password');
    Route::post('/gme-network-forget-password', [CustomerAuthController::class, 'forgotPassword'])->name('customer.forget.password.post');

    //verifyOtpForm
    Route::get('/gme-network-verify-otp', [CustomerAuthController::class, 'showVerifyOtpForm'])->name('customer.verify.otp');
    Route::post('/gme-network-verify-otp', [CustomerAuthController::class, 'verifyOtp'])->name('customer.verify.otp.post');

    //resetPasswordForm
    Route::get('/gme-network-reset-password', [CustomerAuthController::class, 'showResetPasswordForm'])->name('customer.reset.password');
    Route::post('/gme-network-reset-password', [CustomerAuthController::class, 'resetPassword'])->name('customer.reset.password.post');




    Route::post('/business/save-step', [GmeRegController::class, 'saveStep'])->name('gme.business.save-step');
    Route::get('/business/success', [GmeRegController::class, 'success'])->name('gme.business.success');
    Route::get('/get-services/{category}', [GmeRegController::class, 'getServices'])->name('get.services');

});






// Route::post('/logout', [CustomerAuthController::class, 'logout'])->middleware('auth:customer');
Route::post('/forgot-password', [CustomerAuthController::class, 'forgotPassword']);
Route::post('/verify-otp', [CustomerAuthController::class, 'verifyOtp']);
Route::post('/reset-password', [CustomerAuthController::class, 'resetPassword']);





Route::middleware([
    'setLocale',
    CustomerAuth::class,
])->group(function () {

    //////// This is for Customer Own (OK)/////////////


        Route::get('/business/register', [GmeRegController::class, 'showRegisterForm'])->name('gme.business.register');
        Route::get('/gme-business-index', [CustomerController::class, 'gmeBusinessIndex'])->name('customer.gme-business-form.index');

        // API route (JSON ONLY)
        Route::get('/api/customer/gme-businesses', [CustomerController::class, 'indexAjax'])
            ->name('customer.gme-business.ajax');
        // get category ajax
        Route::get('/get-category', [CustomerController::class, 'getCategoryAjax'])->name('customer.get-category.ajax');
        //get Location Ajax
        Route::get('/get-locations', [CustomerController::class, 'getLocationAjax'])->name('customer.get-locations.ajax');


        // Auto-upload routes
        Route::post('/gme-business/upload-file', [GmeRegController::class, 'uploadFile'])
            ->name('gme.business.upload-file');

        Route::post('/gme-business/delete-file', [GmeRegController::class, 'deleteFile'])
            ->name('gme.business.delete-file');

        Route::post('/gme-business/upload-gallery', [GmeRegController::class, 'uploadGallery'])
            ->name('gme.business.upload-gallery');

        Route::post('/gme-business/delete-gallery-photo', [GmeRegController::class, 'deleteGalleryPhoto'])
            ->name('gme.business.delete-gallery-photo');



    ///////////////////////////////////////////////////


    Route::get('/customer/dashboard', [CustomerAuthController::class, 'customerDashboard'])->name('customer.dashboard');
    Route::get('/customer/logout', [CustomerAuthController::class, 'cusLogout'])->name('customer.logout');


    Route::get('/customer/profile', [CustomerController::class, 'customerProfile'])->name('customer.profile');
    Route::put('/customer/profile', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');

    Route::get('/update-password', [CustomerController::class, 'updatePassword'])->name('customer.updatePassword');
    Route::post('/update-password', [CustomerController::class, 'storeUpdatePassword'])->name('customer.storeUpdatePassword');


    Route::get('/gme-business-form', [CustomerController::class, 'createGmeBusinessForm'])->name('customer.gme-business-form.create');

    Route::get('/gme-business-form/{business}', [CustomerController::class, 'show'])->name('customer.gme-business-form.show');
    Route::patch('/gme-business/{id}/request-delete', [CustomerController::class, 'requestDelete'])->name('gme.business.requestDelete');
    Route::delete('/gme-business/{id}', [CustomerController::class, 'draftDestroy'])->name('gme.business.destroy');

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



    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('business-categories', BusinessCategoryController::class);
    Route::resource('services', ServiceController::class);

    Route::get('gme-business-admin/{id}/print', [GmeBusinessAdminController::class, 'print'])
    ->name('gme-business-admin.print');

    Route::resource('gme-business', FrontendGmeBusinessController::class);
    Route::get('gme-business-admin/{id}/show', [GmeBusinessAdminController::class, 'show'])
    ->name('gme-business-admin.show');


    Route::resource('gme-business-admin', GmeBusinessAdminController::class);

    // Route::get('/gme-business-admin/export-all', [GmeBusinessExportController::class, 'exportAll'])
    //     ->name('gme-business-admin.export-all');
    
    // Route::get('/gme-business-admin/export-pending', [GmeBusinessExportController::class, 'exportPending'])
    //     ->name('gme-business-admin.export-pending');
    
    // Route::get('/gme-business-admin/export-approved', [GmeBusinessExportController::class, 'exportApproved'])
    //     ->name('gme-business-admin.export-approved');
    // Route::get('export-data', [AdminController::class, 'exportAllPage'])->name('admin.dashboard.export-data');

        // Export Page Views
    Route::get('gme/export-all-page', [GmeBusinessExportController::class, 'exportAllPage'])
        ->name('exportAllPage');
    
    Route::get('gme/export-pending-page', [GmeBusinessExportController::class, 'exportPendingPage'])
        ->name('exportPendingPage');
    
    Route::get('gme/export-approved-page', [GmeBusinessExportController::class, 'exportApprovedPage'])
        ->name('exportApprovedPage');
    
    // Export Download Routes
    Route::get('gme/export-all', [GmeBusinessExportController::class, 'exportAll'])
        ->name('exportAll');
    
    Route::get('gme/export-pending', [GmeBusinessExportController::class, 'exportPending'])
        ->name('exportPending');
    
    Route::get('gme/export-approved', [GmeBusinessExportController::class, 'exportApproved'])
        ->name('exportApproved');

    //Contact////
    Route::prefix('admin/contact-requests')->name('contact-requests.')->group(function () {
        Route::get('/', [GmeBusinessAdminController::class, 'contactRequestsIndex'])->name('index');
        Route::get('/{id}', [GmeBusinessAdminController::class, 'contactRequestsShow'])->name('show');
        Route::post('/{id}/approve', [GmeBusinessAdminController::class, 'contactRequestsApprove'])->name('approve');
        Route::post('/{id}/reject', [GmeBusinessAdminController::class, 'contactRequestsReject'])->name('reject');
    });

        

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
