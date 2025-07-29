<?php
// Disable error reporting untuk production
error_reporting(0);
ini_set('display_errors', 0);

// Set headers
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Simple test response first
if (isset($_GET['test']) && $_GET['test'] === 'simple') {
    echo json_encode([
        'status' => 'success',
        'message' => 'PHP file berfungsi',
        'timestamp' => date('Y-m-d H:i:s'),
        'server' => $_SERVER['SERVER_NAME'] ?? 'unknown'
    ]);
    exit;
}

try {
    // Get parameters
    $mobilId = $_GET['mobil_id'] ?? null;
    $tanggalPinjam = $_GET['tanggal_pinjam'] ?? null;
    $tanggalKembali = $_GET['tanggal_kembali'] ?? null;
    
    // Validate parameters
    if (!$mobilId || !$tanggalPinjam || !$tanggalKembali) {
        echo json_encode([
            'available' => false,
            'message' => 'Parameter tidak lengkap',
            'debug' => [
                'mobil_id' => $mobilId,
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_kembali' => $tanggalKembali,
                'method' => $_SERVER['REQUEST_METHOD'],
                'uri' => $_SERVER['REQUEST_URI']
            ]
        ]);
        exit;
    }

    // For now, just return a simple response without database
    echo json_encode([
        'available' => true,
        'message' => 'Mobil tersedia (test response)',
        'debug' => [
            'mobil_id' => $mobilId,
            'tanggal_pinjam' => $tanggalPinjam,
            'tanggal_kembali' => $tanggalKembali,
            'note' => 'Database connection disabled for testing'
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