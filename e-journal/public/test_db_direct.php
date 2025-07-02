<?php
require_once '../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;

// Create database connection without Laravel
$capsule = new DB;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'e_journal',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

try {
    // Test connection
    $pdo = $capsule->getConnection()->getPdo();
    echo "Database connection successful!\n";
    
    // Test if tables exist
    $result = $capsule->select("SHOW TABLES");
    echo "Tables found: " . count($result) . "\n";
    
    foreach ($result as $table) {
        $tableName = array_values((array) $table)[0];
        echo "- $tableName\n";
    }
    
} catch (Exception $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
}
?>
