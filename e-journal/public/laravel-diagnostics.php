<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    // Bootstrap Laravel
    require_once '../vendor/autoload.php';
    $app = require_once '../bootstrap/app.php';
    
    // Test Laravel components
    $tests = [];
    
    // Test 1: Basic app creation
    $tests['app_created'] = $app !== null;
    
    // Test 2: Kernel creation
    try {
        $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
        $tests['kernel_created'] = true;
    } catch (Exception $e) {
        $tests['kernel_created'] = false;
        $tests['kernel_error'] = $e->getMessage();
    }
    
    // Test 3: Route loading
    try {
        $router = $app->make('router');
        $tests['router_created'] = true;
        
        // Get all routes
        $routes = $router->getRoutes();
        $apiRoutes = [];
        
        foreach ($routes as $route) {
            if (strpos($route->uri(), 'api/') === 0) {
                $apiRoutes[] = [
                    'method' => implode('|', $route->methods()),
                    'uri' => $route->uri(),
                    'name' => $route->getName(),
                    'action' => $route->getActionName()
                ];
            }
        }
        
        $tests['api_routes'] = $apiRoutes;
        $tests['total_routes'] = count($routes->getRoutes());
        
    } catch (Exception $e) {
        $tests['router_created'] = false;
        $tests['router_error'] = $e->getMessage();
    }
    
    // Test 4: Database connection
    try {
        $db = $app->make('db');
        $pdo = $db->connection()->getPdo();
        $tests['database_connected'] = true;
    } catch (Exception $e) {
        $tests['database_connected'] = false;
        $tests['database_error'] = $e->getMessage();
    }
    
    echo json_encode([
        'success' => true,
        'message' => 'Laravel diagnostics completed',
        'data' => $tests
    ], JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Laravel bootstrap failed',
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ], JSON_PRETTY_PRINT);
}
?>
