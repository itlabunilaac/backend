<?php

echo "🔄 Testing MySQL Connection...\n";

try {
    $pdo = new PDO(
        "mysql:host=localhost;port=3306;dbname=e_jurnal", 
        "root", 
        ""
    );
    
    echo "✅ MySQL Connection Successful!\n";
    echo "📊 Database: e_jurnal\n";
    echo "🖥️  Host: localhost:3306\n\n";
    
    // Test tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        echo "⚠️  No tables found. Run migrations:\n";
        echo "   php artisan migrate:fresh --seed\n";
    } else {
        echo "📋 Tables found:\n";
        foreach ($tables as $table) {
            echo "   - $table\n";
        }
    }
    
} catch (PDOException $e) {
    echo "❌ MySQL Connection Failed!\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    
    echo "🔧 Checklist:\n";
    echo "   1. ✅ Database 'e_jurnal' created in phpMyAdmin\n";
    echo "   2. ⚠️  Check if MySQL is running in Laragon\n";
    echo "   3. ⚠️  Verify database name is 'e_jurnal'\n";
    echo "   4. ⚠️  Check username (root) and password (empty)\n";
}
