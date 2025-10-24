<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;

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
Route::prefix('master')
    ->middleware('auth')
    ->group(function () {
        Route::view('/', 'master.index')->name('master.index');
        Route::view('/produk', 'master.produk.index')->name('master.produk.index');
        Route::view('/pelanggan', 'master.pelanggan.index')->name('master.pelanggan.index');
    });

// Master Produk
Route::middleware('auth')
    ->prefix('master')
    ->name('master.')
    ->group(function () {
        Route::resource('produk', ProdukController::class)->except(['create', 'edit', 'show']);
    });

// Master Pengeluaran
Route::middleware('auth')
    ->prefix('master')
    ->name('master.')
    ->group(function () {
        Route::resource('pengeluaran', PengeluaranController::class)->except(['create', 'show']);
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

//Laporan

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

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
