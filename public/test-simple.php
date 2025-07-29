<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

echo json_encode([
    'status' => 'success',
    'message' => 'File PHP berfungsi dengan baik',
    'timestamp' => date('Y-m-d H:i:s'),
    'server' => $_SERVER['SERVER_NAME'] ?? 'unknown',
    'php_version' => PHP_VERSION,
    'method' => $_SERVER['REQUEST_METHOD']
]);
?> 