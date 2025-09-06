<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LogoutController;

// Admin Controllers
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\ProdukController as AdminProdukController;
use App\Http\Controllers\admin\TransaksiController as AdminTransaksiController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\InvoiceController;

// User Controllers
use App\Http\Controllers\users\ProdukController as UserProdukController;
use App\Http\Controllers\users\TransaksiController as UserTransaksiController;
use App\Http\Controllers\users\UserController as UserUserController;
use App\Http\Controllers\CartController;


// ========================
// AUTH ROUTES
// ========================
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomLoginController::class, 'login'])->name('login.custom');
Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


// ========================
// REGISTRATION VERIFICATION ROUTES
// ========================
Route::get('/email/verify', function () {
    return view('auth.verify-email'); // halaman instruksi
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('dashboard'); // pakai name route, bukan hardcode /dashboard
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Link verifikasi telah dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

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
Route::get('/invoice/{id}', [InvoiceController::class, 'generateInvoice'])
    ->name('invoice.generate');

// ========================
// USER ROUTES
// ========================
Route::resource('produk', UserProdukController::class)->only(['index', 'show']);
Route::post('/transaksi', [UserTransaksiController::class, 'store'])
    ->name('transaksi.store')
    ->middleware('auth');
Route::get('/user', [UserUserController::class, 'index'])->name('user.index');
Route::resource('cart', CartController::class)->middleware('auth');
Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});