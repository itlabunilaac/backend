#!/usr/bin/env php
<?php
// Quick test script untuk E-Journal API

$baseUrl = 'http://127.0.0.1:8000/api';

echo "🧪 Testing E-Journal API\n";
echo "========================\n\n";

// Test 1: Register Admin
echo "1. Testing Admin Register...\n";
$registerData = [
    'username' => 'testadmin',
    'email' => 'test@admin.com',
    'password' => 'password123',
    'password_confirmation' => 'password123'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl . '/admin/register');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($registerData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Status: $httpCode\n";
echo "Response: $response\n\n";

// Test 2: Login Admin
echo "2. Testing Admin Login...\n";
$loginData = [
    'login' => 'test@admin.com',
    'password' => 'password123'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl . '/admin/login');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($loginData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Status: $httpCode\n";
echo "Response: $response\n\n";

$loginResponse = json_decode($response, true);
$token = $loginResponse['data']['token'] ?? null;

if ($token) {
    echo "🔑 Token received: " . substr($token, 0, 20) . "...\n\n";
    
    // Test 3: Get Profile
    echo "3. Testing Get Profile...\n";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseUrl . '/admin/profile');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $token,
        'Accept: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "Status: $httpCode\n";
    echo "Response: $response\n\n";
    
    // Test 4: Create Jurnal
    echo "4. Testing Create Jurnal...\n";
    $jurnalData = [
        'judul' => 'Test Jurnal',
        'subject' => 'Teknologi',
        'akreditasi' => 'Sinta 1',
        'penerbit' => 'Test Publisher',
        'deskripsi' => 'Jurnal test untuk API'
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseUrl . '/admin/jurnal');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jurnalData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json',
        'Accept: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "Status: $httpCode\n";
    echo "Response: $response\n\n";
    
} else {
    echo "❌ No token received, cannot test authenticated endpoints\n";
}

// Test 5: Get All Jurnal (public)
echo "5. Testing Get All Jurnal...\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl . '/jurnal');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Status: $httpCode\n";
echo "Response: $response\n\n";

echo "✅ Testing completed!\n";
