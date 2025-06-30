<?php

require_once 'vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $pdo = new PDO(
        "mysql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_DATABASE'],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD']
    );
    
    echo "✅ Database connection successful!\n";
    echo "Database: " . $_ENV['DB_DATABASE'] . "\n";
    echo "Host: " . $_ENV['DB_HOST'] . ":" . $_ENV['DB_PORT'] . "\n";
    
    // Test query
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "\n📋 Tables in database:\n";
    foreach ($tables as $table) {
        echo "  - $table\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    echo "\n🔧 Please check:\n";
    echo "  1. MySQL/MariaDB is running\n";
    echo "  2. Database 'e_journal' exists\n";
    echo "  3. Username and password are correct\n";
}
