<?php
header('Content-Type: application/json');

$mobil_id = $_GET['mobil_id'] ?? '1';
$tanggal_pinjam = $_GET['tanggal_pinjam'] ?? '2025-01-01';
$tanggal_kembali = $_GET['tanggal_kembali'] ?? '2025-01-02';

echo json_encode([
    'available' => true,
    'message' => 'Mobil tersedia (test)',
    'data' => [
        'mobil_id' => $mobil_id,
        'tanggal_pinjam' => $tanggal_pinjam,
        'tanggal_kembali' => $tanggal_kembali
    ]
]);
?> 