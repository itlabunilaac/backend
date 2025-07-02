<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

echo json_encode([
    'success' => true,
    'message' => 'E-Journal API is running (Fallback Mode)!',
    'version' => '1.0.0-fallback',
    'timestamp' => date('Y-m-d H:i:s'),
    'info' => [
        'note' => 'This is a direct PHP fallback API for demo purposes',
        'php_version' => phpversion(),
        'server' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
        'endpoints' => [
            'POST /api-login.php - Admin login',
            'POST /api-register.php - Admin register',
            'GET /direct-api-test.php - Basic API test'
        ]
    ]
]);
?>
