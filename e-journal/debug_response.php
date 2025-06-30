<?php
// Simple test untuk debug token issue

// Test 1: Manual token verification
$testToken = 'fa168b44a04ca9afa5b1d7e8da887477ac1b580c7aa1ec7da1c0ffe8b840f888ef26912d85e0e69f';

echo "Testing token: " . substr($testToken, 0, 20) . "...\n";

// Test 2: Manual curl request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/admin/profile');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $testToken,
    'Accept: application/json',
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Error: $error\n";
echo "Response length: " . strlen($response) . "\n";
echo "Response (first 500 chars):\n";
echo substr($response, 0, 500) . "\n";
echo "---\n";
echo "Response (last 500 chars):\n";
echo substr($response, -500) . "\n";

// Try to decode JSON
$decoded = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "JSON Error: " . json_last_error_msg() . "\n";
    echo "JSON Error Code: " . json_last_error() . "\n";
} else {
    echo "JSON decoded successfully:\n";
    print_r($decoded);
}
