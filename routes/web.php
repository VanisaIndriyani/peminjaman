<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\MobilController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Models\Mobil;
use App\Http\Controllers\User\PeminjamanController as UserPeminjamanController;

Route::get('/', function () {
    return view('user.beranda');
});

// Route User
Route::prefix('user')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index']);
});

// Route halaman user tanpa prefix
Route::get('/beranda', function () {
    return view('user.beranda');
});
Route::get('/tentang', function () {
    return view('user.tentang');
});
Route::get('/katalog', function () {
    $mobils = Mobil::all();
    return view('user.katalog', compact('mobils'));
})->name('katalog');
Route::get('/kontak', function () {
    return view('user.kontak');
});
Route::post('/kontak', [App\Http\Controllers\PesanController::class, 'store'])->name('kontak.kirim');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/peminjaman/create', [UserPeminjamanController::class, 'create'])->middleware('auth');
Route::post('/peminjaman', [UserPeminjamanController::class, 'store'])->middleware('auth');
Route::get('/riwayat', [App\Http\Controllers\User\RiwayatController::class, 'index'])->middleware('auth');

// Route Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('/dashboard/stats', [App\Http\Controllers\Admin\DashboardController::class, 'getDashboardStats']);
    Route::get('/dashboard/chart-data', [App\Http\Controllers\Admin\DashboardController::class, 'getChartData']);
    Route::get('/dashboard/statistics', [App\Http\Controllers\Admin\DashboardController::class, 'getStatistics']);
    Route::resource('mobil', MobilController::class);
    Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'show']);
    Route::post('peminjaman/{id}/aksi', [PeminjamanController::class, 'aksi'])->name('admin.peminjaman.aksi');
    Route::post('peminjaman/{id}/pengembalian-manual', [App\Http\Controllers\Admin\PeminjamanController::class, 'pengembalianManual'])->name('admin.peminjaman.pengembalianManual');
    Route::resource('pengembalian', PengembalianController::class)->only(['index', 'show', 'destroy']);
    Route::post('pengembalian/{id}/selesaikan', [App\Http\Controllers\Admin\PengembalianController::class, 'selesaikan'])->name('admin.pengembalian.selesaikan');
    Route::resource('pengguna', PenggunaController::class)->only(['index']);
    Route::resource('laporan', LaporanController::class)->only(['index']);
    Route::resource('pesan', App\Http\Controllers\Admin\PesanController::class)->only(['index']);
    Route::get('profile', [ProfileController::class, 'show'])->name('admin.profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::resource('pengembalian', \App\Http\Controllers\Admin\PengembalianController::class);
    Route::post('peminjaman/{id}/selesaikan', [App\Http\Controllers\Admin\PeminjamanController::class, 'selesaikan'])->name('peminjaman.selesaikan');
});
