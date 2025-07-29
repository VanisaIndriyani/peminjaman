<?php
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

try {
    // Get parameters
    $mobilId = $_GET['mobil_id'] ?? '1';
    $tanggalPinjam = $_GET['tanggal_pinjam'] ?? '2025-01-01';
    $tanggalKembali = $_GET['tanggal_kembali'] ?? '2025-01-02';
    
    // Load database configuration
    $dbConfig = include 'db-config.php';
    $host = $dbConfig['host'];
    $dbname = $dbConfig['dbname'];
    $username = $dbConfig['username'];
    $password = $dbConfig['password'];
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check for overlapping bookings
    $sql = "SELECT COUNT(*) as count FROM peminjaman 
            WHERE mobil_id = ? 
            AND status IN ('menunggu_pembayaran', 'disetujui', 'dipinjam')
            AND (
                (tanggal_pinjam <= ? AND tanggal_kembali >= ?) OR
                (tanggal_pinjam <= ? AND tanggal_kembali >= ?) OR
                (tanggal_pinjam >= ? AND tanggal_kembali <= ?)
            )";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$mobilId, $tanggalKembali, $tanggalPinjam, $tanggalKembali, $tanggalKembali, $tanggalPinjam, $tanggalKembali]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $isAvailable = $result['count'] == 0;
    
    echo json_encode([
        'available' => $isAvailable,
        'message' => $isAvailable ? 'Mobil tersedia' : 'Mobil tidak tersedia',
        'data' => [
            'mobil_id' => $mobilId,
            'tanggal_pinjam' => $tanggalPinjam,
            'tanggal_kembali' => $tanggalKembali,
            'overlapping_bookings' => $result['count']
        ]
    ]);
    
} catch (\Exception $e) {
    echo json_encode([
        'available' => false,
        'message' => 'Error: ' . $e->getMessage(),
        'debug' => [
            'file' => 'check-avail.php',
            'error' => $e->getMessage()
        ]
    ]);
}
?> 