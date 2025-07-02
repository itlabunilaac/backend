<?php
// Simple test file to check if Laravel 10 bootstrap works

echo "<h1>Laravel 10 Bootstrap Test</h1>";

try {
    define('LARAVEL_START', microtime(true));
    
    echo "<p>✅ Laravel START defined</p>";
    
    // Load autoloader
    require __DIR__ . '/../vendor/autoload.php';
    echo "<p>✅ Autoloader loaded</p>";
    
    // Bootstrap app
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    echo "<p>✅ Bootstrap loaded</p>";
    
    echo "<p>App class: " . get_class($app) . "</p>";
    echo "<p>Laravel version: " . $app->version() . "</p>";
    echo "<p>Environment: " . $app->environment() . "</p>";
    
    // Test kernel
    $kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
    echo "<p>✅ HTTP Kernel created: " . get_class($kernel) . "</p>";
    
    echo "<h2>✅ Laravel 10 Bootstrap SUCCESS!</h2>";
    
} catch (Exception $e) {
    echo "<h2>❌ Error: " . $e->getMessage() . "</h2>";
    echo "<p>File: " . $e->getFile() . "</p>";
    echo "<p>Line: " . $e->getLine() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>
