<?php
// Manual test untuk login dan token

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

echo "🧪 Manual Token Test\n";
echo "===================\n\n";

// 1. Find or create admin
$admin = Admin::where('email', 'imamariadi775@gmail.com')->first();

if (!$admin) {
    echo "❌ Admin not found\n";
    exit;
}

echo "✅ Admin found: {$admin->email} (ID: {$admin->id})\n\n";

// 2. Create token manually
echo "🔑 Creating token...\n";
$tokenObj = $admin->createToken('manual-test');
$token = $tokenObj->plainTextToken;

echo "Token created: {$token}\n\n";

// 3. Test cache lookup
echo "🔍 Testing cache lookup...\n";
$cacheKey = "admin_token_{$token}";
$tokenData = Cache::get($cacheKey);

echo "Cache key: {$cacheKey}\n";
echo "Cache data: " . json_encode($tokenData, JSON_PRETTY_PRINT) . "\n\n";

// 4. Test validation logic
if ($tokenData) {
    echo "✅ Token found in cache\n";
    
    // Check expiration
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
        echo "Time difference: " . $now->diffInMinutes($expiresAt) . " minutes remaining\n";
    }
    
    // Test admin lookup
    $foundAdmin = Admin::find($tokenData['admin_id']);
    if ($foundAdmin) {
        echo "✅ Admin lookup successful: {$foundAdmin->email}\n";
    } else {
        echo "❌ Admin lookup failed\n";
    }
} else {
    echo "❌ Token not found in cache\n";
}

echo "\n🎯 Use this token for testing: {$token}\n";
