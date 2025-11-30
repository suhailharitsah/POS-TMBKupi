<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\VendorController;
// Route ke login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Route ke register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Route (dashboard kasir)
Route::get('/dashboard', function () {
    return view('dashboard.index');
})
    ->middleware('auth')
    ->name('dashboard');

// Master
Route::middleware('auth')
    ->prefix('master')
    ->name('master.')
    ->group(function () {
        Route::view('/', 'master.index')->name('index');

        Route::view('/produk', 'master.produk.index')->name('produk.index');
        Route::view('/pelanggan', 'master.pelanggan.index')->name('pelanggan.index');

        Route::resource('produk', ProdukController::class)->except(['create', 'edit', 'show']);
        Route::resource('pengeluaran', PengeluaranController::class)->except(['create', 'show']);

        // Stok Produk
        Route::get('/stok', [StokController::class, 'index'])->name('stok.index');

        // 🔹 Vendor
        Route::resource('vendor', VendorController::class)->except(['show']);
    });

// Transaksi
Route::middleware('auth')
    ->prefix('transaksi')
    ->name('transaksi.')
    ->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('index');
        Route::post('/', [TransaksiController::class, 'store'])->name('store');
        Route::put('/{id}/batal', [TransaksiController::class, 'batal'])->name('batal');
        Route::delete('/{id}', [TransaksiController::class, 'destroy'])->name('destroy');
    });

// Employee
Route::middleware('auth')
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::post('/', [EmployeeController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::put('/{id}', [EmployeeController::class, 'update'])->name('update');
        Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('destroy');
    });

// Users
Route::middleware('auth')
    ->prefix('users')
    ->name('users.')
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

// Laporan
Route::middleware('auth')
    ->prefix('laporan')
    ->name('laporan.')
    ->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/penjualan', [LaporanPenjualanController::class, 'index'])->name('penjualan');
    });

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
