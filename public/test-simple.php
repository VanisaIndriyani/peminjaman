<?php
// Disable error reporting
error_reporting(0);
ini_set('display_errors', 0);

// Set headers
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// Simple response
echo json_encode([
    'status' => 'success',
    'message' => 'File PHP berfungsi dengan baik',
    'timestamp' => date('Y-m-d H:i:s'),
    'server' => $_SERVER['SERVER_NAME'] ?? 'unknown',
    'php_version' => PHP_VERSION,
    'method' => $_SERVER['REQUEST_METHOD'],
    'uri' => $_SERVER['REQUEST_URI']
]);
?> 