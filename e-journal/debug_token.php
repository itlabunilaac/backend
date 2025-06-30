<?php
// Debug script untuk token authentication

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Cache;
use App\Models\Admin;

// Test token yang diberikan user
$testToken = 'fa168b44a04ca9afa5b1d7e8da887477ac1b580c7aa1ec7da1c0ffe8b840f888ef26912d85e0e69f';

echo "🔍 Debugging Token: {$testToken}\n\n";

// 1. Test cache lookup
echo "1. Testing Cache Lookup:\n";
$cacheKey = "admin_token_{$testToken}";
$tokenData = Cache::get($cacheKey);
echo "Cache key: {$cacheKey}\n";
echo "Cache data: " . json_encode($tokenData) . "\n\n";

// 2. Test admin lookup
if ($tokenData && isset($tokenData['admin_id'])) {
    echo "2. Testing Admin Lookup:\n";
    $admin = Admin::find($tokenData['admin_id']);
    if ($admin) {
        echo "✅ Admin found: {$admin->email} (ID: {$admin->id})\n";
    } else {
        echo "❌ Admin not found for ID: {$tokenData['admin_id']}\n";
    }
} else {
    echo "2. Cannot test admin lookup - no valid token data\n";
}

// 3. Test expiration
if ($tokenData && isset($tokenData['expires_at'])) {
    echo "\n3. Testing Token Expiration:\n";
    $expiresAt = $tokenData['expires_at'];
    $now = now();
    
    echo "Expires at: {$expiresAt}\n";
    echo "Current time: {$now}\n";
    
    if (is_string($expiresAt)) {
        $expiresAt = \Carbon\Carbon::parse($expiresAt);
        echo "Parsed expires at: {$expiresAt}\n";
    }
    
    if ($expiresAt < $now) {
        echo "❌ Token is EXPIRED\n";
    } else {
        echo "✅ Token is VALID\n";
    }
}

// 4. Test database lookup (if table exists)
echo "\n4. Testing Database Lookup:\n";
try {
    $adminToken = \App\Models\AdminToken::where('token', $testToken)->first();
    if ($adminToken) {
        echo "✅ Token found in database\n";
        echo "Admin ID: {$adminToken->admin_id}\n";
        echo "Expires at: {$adminToken->expires_at}\n";
    } else {
        echo "❌ Token not found in database\n";
    }
} catch (\Exception $e) {
    echo "❌ Database lookup failed: " . $e->getMessage() . "\n";
}

// 5. List all cache keys
echo "\n5. Listing all cache entries with admin_token prefix:\n";
try {
    // This is tricky with database cache, let's try a different approach
    echo "Note: Cannot easily list database cache entries. Trying direct approach...\n";
    
    // Try to find any admin tokens in cache by checking a few keys
    for ($i = 1; $i <= 10; $i++) {
        $key = "admin_token_test_{$i}";
        $data = Cache::get($key);
        if ($data) {
            echo "Found: {$key} = " . json_encode($data) . "\n";
        }
    }
} catch (\Exception $e) {
    echo "Error listing cache: " . $e->getMessage() . "\n";
}
