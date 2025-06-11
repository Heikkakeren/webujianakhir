<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\TransactionController;

// Halaman Admin (hanya bisa diakses oleh user login)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/laptops', [LaptopController::class, 'index'])->name('admin.laptops.index');
    Route::get('/laptops/create', [LaptopController::class, 'create'])->name('admin.laptops.create');
    Route::post('/laptops', [LaptopController::class, 'store'])->name('admin.laptops.store');
    Route::get('/laptops/{laptop}/edit', [LaptopController::class, 'edit'])->name('admin.laptops.edit');
    Route::put('/laptops/{laptop}', [LaptopController::class, 'update'])->name('admin.laptops.update');
    Route::delete('/laptops/{laptop}', [LaptopController::class, 'destroy'])->name('admin.laptops.destroy');
});

// Halaman User (harus login)
Route::middleware(['auth'])->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('user.home');
    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
    Route::get('/search', [TransactionController::class, 'search'])->name('search');
});

// Auth Routes (Login, Register, dll)
Auth::routes();

// Redirect ke homepage setelah login
Route::get('/home', function () {
    return redirect('/');
})->name('home')->middleware('auth');