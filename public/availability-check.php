<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try {
    // Include Laravel bootstrap
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../bootstrap/app.php';
    
    // Get parameters
    $mobilId = $_GET['mobil_id'] ?? $_POST['mobil_id'] ?? null;
    $tanggalPinjam = $_GET['tanggal_pinjam'] ?? $_POST['tanggal_pinjam'] ?? null;
    $tanggalKembali = $_GET['tanggal_kembali'] ?? $_POST['tanggal_kembali'] ?? null;
    
    if (!$mobilId || !$tanggalPinjam || !$tanggalKembali) {
        echo json_encode([
            'available' => false,
            'message' => 'Parameter tidak lengkap',
            'debug' => [
                'mobil_id' => $mobilId,
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_kembali' => $tanggalKembali
            ]
        ]);
        exit;
    }

    // Get mobil
    $mobil = \App\Models\Mobil::find($mobilId);
    if (!$mobil) {
        echo json_encode([
            'available' => false,
            'message' => 'Mobil tidak ditemukan dengan ID: ' . $mobilId
        ]);
        exit;
    }

    // Check availability
    $isAvailable = $mobil->isAvailableForDateRange($tanggalPinjam, $tanggalKembali);

    echo json_encode([
        'available' => $isAvailable,
        'message' => $isAvailable ? 'Mobil tersedia untuk tanggal yang dipilih' : 'Mobil tidak tersedia untuk tanggal yang dipilih',
        'debug' => [
            'mobil_id' => $mobilId,
            'mobil_nama' => $mobil->nama,
            'tanggal_pinjam' => $tanggalPinjam,
            'tanggal_kembali' => $tanggalKembali
        ]
    ]);
    
} catch (\Exception $e) {
    echo json_encode([
        'available' => false,
        'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        'error_details' => [
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]
    ]);
}
?> 