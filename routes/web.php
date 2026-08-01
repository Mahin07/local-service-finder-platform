<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoryController;
// Controllers
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\ProviderServiceController as AdminProviderServiceController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProviderAuthController;
use App\Http\Controllers\ProviderBookingController;
use App\Http\Controllers\ProviderProfileController;
use App\Http\Controllers\ProviderServiceController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\UserBookingListController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserInvoiceController;
use App\Http\Controllers\UserPasswordResetController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserServicesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public & Shared Routes
|--------------------------------------------------------------------------
*/

Route::get('/', HomeController::class)->name('home');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Auth
Route::get('/admin/login', function () {
    if (auth('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }

    return view('admin.adminlogin');
})->name('admin.login');

Route::post('/admin/login', [AdminController::class, 'login'])->middleware('throttle:5,1')->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Protected Area
Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Resources
    Route::resource('managecategories', CategoryController::class);
    Route::resource('manageuser', UserController::class);
    Route::resource('manageprovider', ProviderController::class);
    Route::resource('managebooking', BookingController::class);
    Route::resource('manageservice', ServiceController::class); // From first file

    // Booking Status & Management
    Route::put('/managebooking/status/{id}', [BookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');
    Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('admin.bookings.show');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');

    // Provider Services Management (Admin View)
    Route::get('/provider-services', [AdminProviderServiceController::class, 'index'])->name('admin.provider_services');
    Route::post('/provider-services', [AdminProviderServiceController::class, 'store'])->name('admin.provider_services.store');
    Route::put('/provider-services/{providerService}', [AdminProviderServiceController::class, 'update'])->name('admin.provider_services.update');
    Route::delete('/provider-services/{providerService}', [AdminProviderServiceController::class, 'destroy'])->name('admin.provider_services.delete');

    // Reports
    Route::get('/report', [ReportController::class, 'index'])->name('admin.reports');
});

/*
|--------------------------------------------------------------------------
| User Routes (Customers)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('user.login', ['loginType' => 'user']);
    })->name('login');
    Route::get('/register', function () {
        return view('reg');
    })->name('register');

    // Auth Actions with Throttling
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1')->name('register.user');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:6,1')->name('login.user');

    // OTP
    Route::get('/register/otp', [AuthController::class, 'showOtpForm'])->name('register.otp');
    Route::post('/register/verify-otp', [AuthController::class, 'verifyOtp'])->middleware('throttle:8,1')->name('register.verify_otp');
    Route::post('/register/resend-otp', [AuthController::class, 'resendOtp'])->middleware('throttle:3,1')->name('register.resend_otp');

    // Password Reset
    Route::get('/forgot-password', [UserPasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [UserPasswordResetController::class, 'sendResetLinkEmail'])->middleware('throttle:4,1')->name('password.email');
    Route::get('/reset-password/{token}', [UserPasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [UserPasswordResetController::class, 'reset'])->middleware('throttle:6,1')->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', UserDashboardController::class)->name('dashboard');
    Route::get('/profile', UserProfileController::class)->name('profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Bookings
    Route::get('/my-bookings', UserBookingListController::class)->name('user.bookings');
    Route::get('/my-bookings/{booking}/invoice', UserInvoiceController::class)->name('user.bookings.invoice');

    // Booking Actions
    Route::get('/services-directory/{providerService}/book', [UserBookingController::class, 'create'])->name('services.booking.create');
    Route::post('/services-directory/{providerService}/book', [UserBookingController::class, 'store'])->name('services.booking.store');
});

Route::get('/services-directory', UserServicesController::class)->name('services.directory');

/*
|--------------------------------------------------------------------------
| Provider Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest:provider')->group(function () {
    Route::get('/provider/register', [ProviderAuthController::class, 'showRegisterForm'])->name('provider.register');
    Route::post('/provider/register', [ProviderAuthController::class, 'register'])->middleware('throttle:5,1')->name('provider.register.submit');
    Route::get('/provider/login', [ProviderAuthController::class, 'showLoginForm'])->name('provider.login');
    Route::post('/provider/login', [ProviderAuthController::class, 'login'])->middleware('throttle:6,1')->name('provider.login.submit');
});

Route::middleware('auth:provider')->group(function () {
    Route::get('/provider/dashboard', [ProviderAuthController::class, 'dashboard'])->name('provider.dashboard');
    Route::get('/provider/profile', ProviderProfileController::class)->name('provider.profile');
    Route::post('/provider/profile', [ProviderProfileController::class, 'update'])->name('provider.profile.update');
    Route::post('/provider/logout', [ProviderAuthController::class, 'logout'])->name('provider.logout');

    // Provider Booking Management
    Route::get('/provider/bookings', [ProviderBookingController::class, 'index'])->name('provider.bookings.index');
    Route::post('/provider/bookings/{booking}/approve', [ProviderBookingController::class, 'approve'])->name('provider.bookings.approve');
    Route::post('/provider/bookings/{booking}/finish', [ProviderBookingController::class, 'finish'])->name('provider.bookings.finish');

    // Provider's own Services
    Route::resource('/provider/services', ProviderServiceController::class, [
        'only' => ['index', 'store', 'update', 'destroy'],
        'parameters' => ['services' => 'providerService'],
        'names' => [
            'index' => 'provider.services.index',
            'store' => 'provider.services.store',
            'update' => 'provider.services.update',
            'destroy' => 'provider.services.destroy',
        ],
    ]);
});

/*
|--------------------------------------------------------------------------
| Passkey Beta Endpoints
|--------------------------------------------------------------------------
*/
Route::post('/passkey/register/options', [AuthController::class, 'passkeyRegisterOptions'])->middleware(['guest', 'throttle:6,1'])->name('passkey.register.options');
Route::post('/passkey/register/verify', [AuthController::class, 'passkeyRegisterVerify'])->middleware(['guest', 'throttle:6,1'])->name('passkey.register.verify');
Route::post('/passkey/login/options', [AuthController::class, 'passkeyLoginOptions'])->middleware(['guest', 'throttle:8,1'])->name('passkey.login.options');
Route::post('/passkey/login/verify', [AuthController::class, 'passkeyLoginVerify'])->middleware(['guest', 'throttle:8,1'])->name('passkey.login.verify');
