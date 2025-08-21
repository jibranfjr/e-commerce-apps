<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;

// Admin Controllers
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\ProdukController as AdminProdukController;
use App\Http\Controllers\admin\TransaksiController as AdminTransaksiController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\LaporanController;

// User Controllers
use App\Http\Controllers\users\ProdukController as UserProdukController;
use App\Http\Controllers\users\TransaksiController as UserTransaksiController;
use App\Http\Controllers\users\UserController as UserUserController;

// ========================
// AUTH ROUTES
// ========================
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomLoginController::class, 'login'])->name('login.custom');
Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});

// ========================
// ADMIN ROUTES
// ========================
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', AdminProdukController::class);
    Route::resource('transaksi', AdminTransaksiController::class);
    Route::put('transaksi/{id}/konfirmasi', [AdminTransaksiController::class, 'konfirmasi'])
        ->name('transaksi.konfirmasi');
    Route::resource('users', UserController::class);
    Route::get('laporan/transaksi/pdf', [LaporanController::class, 'transaksiPdf'])
        ->name('laporan.transaksi.pdf');
});

// ========================
// USER ROUTES
// ========================
Route::resource('produk', UserProdukController::class)->only(['index', 'show']);
Route::post('/transaksi', [UserTransaksiController::class, 'store'])
    ->name('transaksi.store')
    ->middleware('auth');
Route::get('/user', [UserUserController::class, 'index'])->name('user.index');