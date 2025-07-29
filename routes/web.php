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
use Illuminate\Http\Request;

// Route availability check dengan database
Route::get('/check-avail', function (Request $request) {
    try {
        $mobilId = $request->get('mobil_id', '1');
        $tanggalPinjam = $request->get('tanggal_pinjam', '2025-01-01');
        $tanggalKembali = $request->get('tanggal_kembali', '2025-01-02');
        
        // Get mobil
        $mobil = \App\Models\Mobil::find($mobilId);
        if (!$mobil) {
            return response()->json([
                'available' => false,
                'message' => 'Mobil tidak ditemukan'
            ], 404);
        }
        
        // Check availability using model method
        $isAvailable = $mobil->isAvailableForDateRange($tanggalPinjam, $tanggalKembali);
        
        return response()->json([
            'available' => $isAvailable,
            'message' => $isAvailable ? 'Mobil tersedia' : 'Mobil tidak tersedia',
            'data' => [
                'mobil_id' => $mobilId,
                'mobil_nama' => $mobil->nama,
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_kembali' => $tanggalKembali
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'available' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
})->name('check.avail');

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

// Route untuk cek ketersediaan mobil
Route::post('/check-availability', function (Request $request) {
    try {
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $mobil = Mobil::find($request->mobil_id);
        $isAvailable = $mobil->isAvailableForDateRange($request->tanggal_pinjam, $request->tanggal_kembali);

        return response()->json([
            'available' => $isAvailable,
            'message' => $isAvailable ? 'Mobil tersedia untuk tanggal yang dipilih' : 'Mobil tidak tersedia untuk tanggal yang dipilih'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'available' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
})->name('check.availability');

// Route fallback untuk cek ketersediaan (tanpa CSRF)
Route::post('/api/check-availability', function (Request $request) {
    try {
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $mobil = Mobil::find($request->mobil_id);
        $isAvailable = $mobil->isAvailableForDateRange($request->tanggal_pinjam, $request->tanggal_kembali);

        return response()->json([
            'available' => $isAvailable,
            'message' => $isAvailable ? 'Mobil tersedia untuk tanggal yang dipilih' : 'Mobil tidak tersedia untuk tanggal yang dipilih'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'available' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
})->name('api.check.availability')->middleware('web');

// Route sederhana untuk cek ketersediaan (GET method untuk testing)
Route::get('/test-availability', function (Request $request) {
    try {
        $mobilId = $request->get('mobil_id');
        $tanggalPinjam = $request->get('tanggal_pinjam');
        $tanggalKembali = $request->get('tanggal_kembali');
        
        if (!$mobilId || !$tanggalPinjam || !$tanggalKembali) {
            return response()->json([
                'available' => false,
                'message' => 'Parameter tidak lengkap'
            ], 400);
        }

        $mobil = Mobil::find($mobilId);
        if (!$mobil) {
            return response()->json([
                'available' => false,
                'message' => 'Mobil tidak ditemukan'
            ], 404);
        }

        $isAvailable = $mobil->isAvailableForDateRange($tanggalPinjam, $tanggalKembali);

        return response()->json([
            'available' => $isAvailable,
            'message' => $isAvailable ? 'Mobil tersedia untuk tanggal yang dipilih' : 'Mobil tidak tersedia untuk tanggal yang dipilih'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'available' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
})->name('test.availability');

// Route untuk cek ketersediaan dengan form data (lebih kompatibel dengan hosting)
Route::post('/check-availability-form', function (Request $request) {
    try {
        // Log untuk debugging
        \Log::info('Availability check request', [
            'method' => $request->method(),
            'headers' => $request->headers->all(),
            'data' => $request->all()
        ]);

        $mobilId = $request->input('mobil_id');
        $tanggalPinjam = $request->input('tanggal_pinjam');
        $tanggalKembali = $request->input('tanggal_kembali');
        
        if (!$mobilId || !$tanggalPinjam || !$tanggalKembali) {
            return response()->json([
                'available' => false,
                'message' => 'Parameter tidak lengkap: mobil_id=' . $mobilId . ', tanggal_pinjam=' . $tanggalPinjam . ', tanggal_kembali=' . $tanggalKembali
            ], 400);
        }

        $mobil = Mobil::find($mobilId);
        if (!$mobil) {
            return response()->json([
                'available' => false,
                'message' => 'Mobil tidak ditemukan dengan ID: ' . $mobilId
            ], 404);
        }

        $isAvailable = $mobil->isAvailableForDateRange($tanggalPinjam, $tanggalKembali);

        return response()->json([
            'available' => $isAvailable,
            'message' => $isAvailable ? 'Mobil tersedia untuk tanggal yang dipilih' : 'Mobil tidak tersedia untuk tanggal yang dipilih',
            'debug' => [
                'mobil_id' => $mobilId,
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_kembali' => $tanggalKembali,
                'mobil_nama' => $mobil->nama
            ]
        ]);
    } catch (\Exception $e) {
        \Log::error('Availability check error', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'available' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
})->name('check.availability.form');

// Route testing sederhana untuk hosting
Route::get('/test-simple', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Route berfungsi dengan baik',
        'timestamp' => now(),
        'server' => $_SERVER['SERVER_NAME'] ?? 'unknown'
    ]);
})->name('test.simple');

// Route testing untuk cek mobil
Route::get('/test-mobil', function () {
    try {
        $mobils = Mobil::all();
        return response()->json([
            'status' => 'success',
            'count' => $mobils->count(),
            'mobils' => $mobils->map(function($mobil) {
                return [
                    'id' => $mobil->id,
                    'nama' => $mobil->nama,
                    'plat_nomor' => $mobil->plat_nomor,
                    'status' => $mobil->status
                ];
            })
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
})->name('test.mobil');

// Route availability check yang sangat sederhana
Route::get('/availability-check', function (Request $request) {
    header('Content-Type: application/json');
    
    try {
        $mobilId = $request->get('mobil_id');
        $tanggalPinjam = $request->get('tanggal_pinjam');
        $tanggalKembali = $request->get('tanggal_kembali');
        
        if (!$mobilId || !$tanggalPinjam || !$tanggalKembali) {
            echo json_encode([
                'available' => false,
                'message' => 'Parameter tidak lengkap'
            ]);
            return;
        }

        $mobil = Mobil::find($mobilId);
        if (!$mobil) {
            echo json_encode([
                'available' => false,
                'message' => 'Mobil tidak ditemukan'
            ]);
            return;
        }

        $isAvailable = $mobil->isAvailableForDateRange($tanggalPinjam, $tanggalKembali);

        echo json_encode([
            'available' => $isAvailable,
            'message' => $isAvailable ? 'Mobil tersedia' : 'Mobil tidak tersedia'
        ]);
        
    } catch (\Exception $e) {
        echo json_encode([
            'available' => false,
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
    
    exit;
});

// Route untuk update status mobil (temporary)
Route::get('/update-mobil-status', function () {
    $mobils = \App\Models\Mobil::all();
    $updatedCount = 0;

    foreach ($mobils as $mobil) {
        // Cek apakah ada peminjaman aktif untuk mobil ini
        $peminjamanAktif = \App\Models\Peminjaman::where('mobil_id', $mobil->id)
            ->whereIn('status', ['menunggu_pembayaran', 'disetujui', 'dipinjam'])
            ->exists();

        $newStatus = $peminjamanAktif ? 'dipinjam' : 'tersedia';
        
        if ($mobil->status !== $newStatus) {
            $oldStatus = $mobil->status;
            $mobil->status = $newStatus;
            $mobil->save();
            $updatedCount++;
            echo "Mobil {$mobil->nama} ({$mobil->plat_nomor}) status diubah dari '{$oldStatus}' ke '{$newStatus}'<br>";
        }
    }

    echo "Update selesai. {$updatedCount} mobil diperbarui.";
})->name('update.mobil.status');

// Route Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('/dashboard/stats', [App\Http\Controllers\Admin\DashboardController::class, 'getDashboardStats']);
    Route::get('/dashboard/chart-data', [App\Http\Controllers\Admin\DashboardController::class, 'getChartData']);
    Route::get('/dashboard/statistics', [App\Http\Controllers\Admin\DashboardController::class, 'getStatistics']);
    Route::resource('mobil', MobilController::class);
    Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'show', 'destroy']);
    Route::post('peminjaman/{id}/aksi', [PeminjamanController::class, 'aksi'])->name('admin.peminjaman.aksi');
    Route::post('peminjaman/{id}/pengembalian-manual', [App\Http\Controllers\Admin\PeminjamanController::class, 'pengembalianManual'])->name('admin.peminjaman.pengembalianManual');
    Route::post('peminjaman/{id}/selesaikan', [App\Http\Controllers\Admin\PeminjamanController::class, 'selesaikan'])->name('peminjaman.selesaikan');
    Route::resource('pengembalian', PengembalianController::class)->only(['index', 'show', 'destroy']);
    Route::post('pengembalian/{id}/selesaikan', [App\Http\Controllers\Admin\PengembalianController::class, 'selesaikan'])->name('admin.pengembalian.selesaikan');
    Route::resource('pengguna', PenggunaController::class)->only(['index', 'destroy']);
    Route::resource('laporan', LaporanController::class)->only(['index']);
    Route::resource('pesan', App\Http\Controllers\Admin\PesanController::class)->only(['index', 'destroy']);
    Route::get('profile', [ProfileController::class, 'show'])->name('admin.profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('admin.profile.update');
});
