<?php
// Script untuk membuat tabel admin_tokens secara manual

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\DB;

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    echo "🔍 Checking if admin_tokens table exists...\n";
    
    // Check if table exists
    $tableExists = DB::select("SHOW TABLES LIKE 'admin_tokens'");
    
    if (empty($tableExists)) {
        echo "❌ Table admin_tokens doesn't exist. Creating...\n";
        
        // Create the table
        DB::statement("
            CREATE TABLE admin_tokens (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                admin_id BIGINT UNSIGNED NOT NULL,
                token VARCHAR(80) UNIQUE NOT NULL,
                name VARCHAR(255) NOT NULL,
                expires_at TIMESTAMP NOT NULL,
                last_used_at TIMESTAMP NULL,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL,
                
                FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE CASCADE,
                INDEX idx_admin_id (admin_id),
                INDEX idx_token (token),
                INDEX idx_expires_at (expires_at)
            )
        ");
        
        echo "✅ Table admin_tokens created successfully!\n";
    } else {
        echo "✅ Table admin_tokens already exists.\n";
        
        // Check if expires_at column exists
        $columns = DB::select("DESCRIBE admin_tokens");
        $hasExpiresAt = false;
        foreach ($columns as $column) {
            if ($column->Field === 'expires_at') {
                $hasExpiresAt = true;
                break;
            }
        }
        
        if (!$hasExpiresAt) {
            echo "🔧 Adding expires_at column...\n";
            DB::statement("ALTER TABLE admin_tokens ADD COLUMN expires_at TIMESTAMP NOT NULL AFTER name");
            DB::statement("ALTER TABLE admin_tokens ADD INDEX idx_expires_at (expires_at)");
            echo "✅ expires_at column added!\n";
        } else {
            echo "✅ expires_at column already exists.\n";
        }
    }
    
    // Show final table structure
    echo "\n📋 Final table structure:\n";
    $columns = DB::select("DESCRIBE admin_tokens");
    foreach ($columns as $column) {
        echo "  {$column->Field} ({$column->Type}) " . ($column->Null === 'NO' ? 'NOT NULL' : 'NULL') . "\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
