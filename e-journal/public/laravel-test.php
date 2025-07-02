<?php
// Simple Laravel bootstrap test
echo "Starting Laravel bootstrap test...\n";

try {
    require_once __DIR__ . '/../vendor/autoload.php';
    echo "✓ Autoload loaded\n";
    
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    echo "✓ App created\n";
    
    // Test kernel creation
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    echo "✓ Kernel created\n";
    
    // Test basic request
    $request = Illuminate\Http\Request::createFromGlobals();
    echo "✓ Request created\n";
    
    echo "Laravel bootstrap successful!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
?>
