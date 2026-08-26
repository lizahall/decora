<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;

Route::get('/', function () {
    return view('welcome');
});

// ================= ADMIN =================
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('produk', AdminProdukController::class);

        Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
        Route::get('/pesanan/{pesanan}', [AdminPesananController::class, 'show'])->name('pesanan.show');
        Route::patch('/pesanan/{pesanan}/status', [AdminPesananController::class, 'updateStatus'])->name('pesanan.updateStatus');

        // Route admin lain (kelola user, kelola admin, laporan) ditambah di Fase 7
    });
});

// ================= PUBLIK (tanpa login) =================
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');

// ================= USER (wajib login) =================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::patch('/keranjang/{keranjang}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{keranjang}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');
});

require __DIR__.'/auth.php';