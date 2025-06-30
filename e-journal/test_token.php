#!/usr/bin/env php
<?php

// Test token authentication system
echo "🧪 Testing Token Authentication System\n";
echo "=====================================\n\n";

$baseUrl = 'http://127.0.0.1:8000/api';

// Test 1: Login Admin
echo "1. Testing Admin Login...\n";
$loginData = [
    'login' => 'admin@example.com',
    'password' => 'password123'
];

$postData = json_encode($loginData);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl . '/admin/login');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json',
    'Content-Length: ' . strlen($postData)
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    echo "❌ CURL Error: $error\n";
    exit(1);
}

echo "Status: $httpCode\n";
echo "Response: " . ($response ?: 'Empty response') . "\n\n";

if ($httpCode === 200) {
    $loginResponse = json_decode($response, true);
    $token = $loginResponse['data']['token'] ?? null;
    
    if ($token) {
        echo "🔑 Token received: " . substr($token, 0, 20) . "...\n\n";
        
        // Test 2: Get Profile with token
        echo "2. Testing Get Profile with token...\n";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $baseUrl . '/admin/profile');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
            'Accept: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        if ($error) {
            echo "❌ CURL Error: $error\n";
        } else {
            echo "Status: $httpCode\n";
            echo "Response: " . ($response ?: 'Empty response') . "\n\n";
            
            if ($httpCode === 200) {
                echo "✅ Token authentication working!\n";
            } else {
                echo "❌ Token authentication failed!\n";
            }
        }
    } else {
        echo "❌ No token in response\n";
    }
} else {
    echo "❌ Login failed\n";
}

echo "\n🏁 Test completed!\n";
