<?php
echo "PHP is working!\n";
echo "Current directory: " . getcwd() . "\n";
echo "PHP version: " . phpversion() . "\n";

// Test if Laravel exists
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo "Autoload file exists\n";
} else {
    echo "Autoload file NOT found\n";
}

// Test if app can be created
try {
    require_once __DIR__ . '/../vendor/autoload.php';
    echo "Autoload loaded successfully\n";
    
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    echo "App created successfully\n";
    
    // Test basic routing
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    echo "Kernel created successfully\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
?>
