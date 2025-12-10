<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;

// ===============================
// ROUTE UMUM (TANPA LOGIN)
// ===============================

// Halaman pertama (About)
Route::get('/', [PageController::class, 'about'])->name('about');

// Halaman About khusus (jika diperlukan)
Route::get('/about', [PageController::class, 'about'])->name('about.page');

// Login
Route::get('/login', [AuthController::class, 'loginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest');

// Register
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');


// ===============================
// SEMUA ROUTE WAJIB LOGIN
// ===============================
Route::middleware(['auth'])->group(function () {

    Route::get('/create', [ShipmentController::class, 'create'])->name('create');
    Route::post('/create', [ShipmentController::class, 'store'])->name('store');

    Route::get('/track', [ShipmentController::class, 'track'])->name('track');
    Route::get('/history', [ShipmentController::class, 'history'])->name('history');

    Route::post('/shipments/{id}/complete', [ShipmentController::class, 'complete'])
        ->name('shipment.complete');

    Route::post('/history/complete/{id}', [ShipmentController::class, 'complete'])
        ->name('history.complete');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/shipment/export/pdf', [\App\Http\Controllers\ShipmentController::class, 'exportPdf'])
    ->name('shipment.export.pdf');
Route::get('/export-pdf', [ShipmentController::class, 'exportPdf'])->name('export.pdf');
});
