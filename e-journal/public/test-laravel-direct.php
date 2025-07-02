<?php
// Direct Laravel API test
require_once '../vendor/autoload.php';

try {
    $app = require_once '../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    
    // Create a test request to /api/test
    $request = Illuminate\Http\Request::create('/api/test', 'GET');
    $request->headers->set('Accept', 'application/json');
    
    $response = $kernel->handle($request);
    
    echo "Status: " . $response->getStatusCode() . "\n";
    echo "Content: " . $response->getContent() . "\n";
    
    $kernel->terminate($request, $response);
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}
?>
