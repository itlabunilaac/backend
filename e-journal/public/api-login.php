<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Only handle POST requests for login
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

// Get input data
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
    exit();
}

$email = $input['email'] ?? '';
$password = $input['password'] ?? '';

// Validate input
if (!$email || !$password) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Validation errors',
        'errors' => [
            'email' => !$email ? ['Email is required'] : [],
            'password' => !$password ? ['Password is required'] : []
        ]
    ]);
    exit();
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Validation errors',
        'errors' => [
            'email' => ['Please enter a valid email address']
        ]
    ]);
    exit();
}

// For demo purposes, accept any valid email and password combination
// Generate a demo token
$token = bin2hex(random_bytes(40));

echo json_encode([
    'success' => true,
    'message' => 'Login successful',
    'data' => [
        'token' => $token,
        'admin' => [
            'id' => 1,
            'email' => $email,
            'username' => explode('@', $email)[0],
            'created_at' => date('Y-m-d H:i:s')
        ]
    ]
]);
?>
