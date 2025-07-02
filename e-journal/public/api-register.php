<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Only handle POST requests for register
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

$username = $input['username'] ?? '';
$email = $input['email'] ?? '';
$password = $input['password'] ?? '';
$passwordConfirmation = $input['password_confirmation'] ?? '';

// Validate input
$errors = [];
if (!$username) $errors['username'] = ['Username is required'];
if (!$email) $errors['email'] = ['Email is required'];
if (!$password) $errors['password'] = ['Password is required'];
if (!$passwordConfirmation) $errors['password_confirmation'] = ['Password confirmation is required'];

if ($password && $passwordConfirmation && $password !== $passwordConfirmation) {
    $errors['password_confirmation'] = ['Password confirmation does not match'];
}

if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = ['Please enter a valid email address'];
}

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Validation errors',
        'errors' => $errors
    ]);
    exit();
}

// For demo purposes, accept any valid input
// Generate a demo token
$token = bin2hex(random_bytes(40));

echo json_encode([
    'success' => true,
    'message' => 'Registration successful',
    'data' => [
        'token' => $token,
        'admin' => [
            'id' => 1,
            'username' => $username,
            'email' => $email,
            'created_at' => date('Y-m-d H:i:s')
        ]
    ]
]);
?>
