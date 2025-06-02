<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
use Illuminate\Support\Facades\DB;

Route::get('/debug', function() {
    try {
        DB::connection()->getPdo();
        return "Database connection is OK.";
    } catch (\Exception $e) {
        return "Database connection error: " . $e->getMessage();
    }
});

// 🏠 Public Pages
Route::view('/', 'layouts.home')->name('home');
Route::view('/about', 'layouts.about')->name('about');
Route::view('/pricing', 'layouts.pricing')->name('pricing');
Route::view('/contact', 'layouts.contact')->name('contact');

// 🧺 Booking Routes (public)
Route::get('/book-laundry', [BookingController::class, 'create'])->name('booking.form');
Route::post('/book-laundry', [BookingController::class, 'store'])->name('booking.store');

// 🔐 Admin Authentication
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// ➕ Add this to fix Laravel auth redirect
Route::get('/login', fn () => redirect()->route('admin.login.form'))->name('login');

// 🛡️ Protected Admin Routes
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Bookings
        Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
        Route::get('/bookings/print-list', [AdminController::class, 'printList'])->name('bookings.print');
        Route::post('/bookings/{booking}/complete', [AdminController::class, 'markCompleted'])->name('bookings.complete');
        Route::delete('/bookings/{booking}', [AdminController::class, 'destroy'])->name('bookings.destroy');
        Route::post('/bookings/bulk-action', [AdminController::class, 'bulkAction'])->name('bookings.bulk-action');
        Route::post('/bookings/export', [AdminController::class, 'export'])->name('bookings.export');
        Route::get('/bookings/{booking}/edit', [AdminController::class, 'edit'])->name('bookings.edit');
        Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

        // Middleware test
        Route::get('/test', fn () => '✅ Admin Middleware is working. You are authenticated and an admin.')->name('test');
    });

// 🔁 Legacy route redirect
Route::redirect('/book', '/book-laundry', 301);
Route::post('/book', fn () => redirect()->route('booking.store'));
