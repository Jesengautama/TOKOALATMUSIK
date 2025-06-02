<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserProdukController;
use App\Http\Controllers\CartController;
use App\Models\Produk;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('/users', UserController::class);
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::resource('transaksi', TransaksiController::class);
Route::post('/transaksi/bayar', [TransaksiController::class, 'bayar'])->name('transaksi.bayar');
Route::get('/transaksi/konfirmasi/{id}', [TransaksiController::class, 'konfirmasi'])->name('transaksi.konfirmasi');
Route::get('/transaksi/invoice/{id}', [TransaksiController::class, 'invoice'])->name('transaksi.invoice');


Route::resource('produk', ProdukController::class);

Route::get('/produk-user', [UserProdukController::class, 'index'])->name('produk.user.index');

Route::post('/cart/add/{id}', function ($id) {
    return back()->with('success', 'Produk ditambahkan ke keranjang (dummy)');
})->name('cart.add');
Route::get('/produk-user/{id}/detail', [UserProdukController::class, 'show'])->name('produk.user.show');


Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');

Route::get('/test-produks', function() {
    return Produk::all();
});

require __DIR__.'/auth.php';
