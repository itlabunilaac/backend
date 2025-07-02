<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Basic admin login simulation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['REQUEST_URI'], '/admin/login') !== false) {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
        exit();
    }
    
    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';
    
    if (!$email || !$password) {
        http_response_code(422);
        echo json_encode([
            'success' => false,
            'message' => 'Email and password are required',
            'errors' => [
                'email' => !$email ? ['Email is required'] : [],
                'password' => !$password ? ['Password is required'] : []
            ]
        ]);
        exit();
    }
    
    // Simple validation - accept any valid email format
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $token = bin2hex(random_bytes(40));
        echo json_encode([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'token' => $token,
                'admin' => [
                    'id' => 1,
                    'email' => $email,
                    'username' => 'admin'
                ]
            ]
        ]);
    } else {
        http_response_code(422);
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email format'
        ]);
    }
    exit();
}

// Basic admin register simulation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['REQUEST_URI'], '/admin/register') !== false) {
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
    
    $errors = [];
    if (!$username) $errors['username'] = ['Username is required'];
    if (!$email) $errors['email'] = ['Email is required'];
    if (!$password) $errors['password'] = ['Password is required'];
    if ($password !== $passwordConfirmation) $errors['password_confirmation'] = ['Password confirmation does not match'];
    
    if (!empty($errors)) {
        http_response_code(422);
        echo json_encode([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $errors
        ]);
        exit();
    }
    
    $token = bin2hex(random_bytes(40));
    echo json_encode([
        'success' => true,
        'message' => 'Registration successful',
        'data' => [
            'token' => $token,
            'admin' => [
                'id' => 1,
                'username' => $username,
                'email' => $email
            ]
        ]
    ]);
    exit();
}

// Default response
echo json_encode([
    'success' => true,
    'message' => 'Fallback API test is working!',
    'info' => 'This is a fallback API endpoint for testing'
]);
?>
