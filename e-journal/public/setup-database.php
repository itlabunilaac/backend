<?php
// Database setup and test
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    // Connect to MySQL
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS e_journal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    
    // Connect to the specific database
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=e_journal', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if tables exist
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Create basic tables if they don't exist
    if (!in_array('admins', $tables)) {
        $pdo->exec("
            CREATE TABLE admins (
                id bigint unsigned NOT NULL AUTO_INCREMENT,
                username varchar(255) NOT NULL,
                email varchar(255) NOT NULL UNIQUE,
                password varchar(255) NOT NULL,
                created_at timestamp NULL DEFAULT NULL,
                updated_at timestamp NULL DEFAULT NULL,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
    }
    
    if (!in_array('jurnals', $tables)) {
        $pdo->exec("
            CREATE TABLE jurnals (
                id bigint unsigned NOT NULL AUTO_INCREMENT,
                judul varchar(255) NOT NULL,
                penulis varchar(255) NOT NULL,
                subjek varchar(255) NOT NULL,
                akreditasi varchar(255) NOT NULL,
                views int unsigned NOT NULL DEFAULT 0,
                url varchar(255) DEFAULT NULL,
                created_at timestamp NULL DEFAULT NULL,
                updated_at timestamp NULL DEFAULT NULL,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
    }
    
    // Insert sample data
    $adminCount = $pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
    if ($adminCount == 0) {
        $stmt = $pdo->prepare("INSERT INTO admins (username, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
        $stmt->execute(['admin', 'admin@example.com', password_hash('password', PASSWORD_DEFAULT)]);
    }
    
    $jurnalCount = $pdo->query("SELECT COUNT(*) FROM jurnals")->fetchColumn();
    if ($jurnalCount == 0) {
        $sampleJurnals = [
            ['Pengembangan Aplikasi Web Modern', 'Dr. Ahmad Suharto', 'Teknologi Informasi', 'Sinta 2', 150],
            ['Analisis Machine Learning untuk Prediksi', 'Prof. Siti Nurhaliza', 'Informatika', 'Sinta 1', 230],
            ['Sistem Keamanan Jaringan Komputer', 'Dr. Budi Santoso', 'Keamanan Siber', 'Sinta 3', 89]
        ];
        
        $stmt = $pdo->prepare("INSERT INTO jurnals (judul, penulis, subjek, akreditasi, views, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
        foreach ($sampleJurnals as $jurnal) {
            $stmt->execute($jurnal);
        }
    }
    
    // Get current status
    $adminCount = $pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
    $jurnalCount = $pdo->query("SELECT COUNT(*) FROM jurnals")->fetchColumn();
    
    echo json_encode([
        'success' => true,
        'message' => 'Database setup completed successfully',
        'data' => [
            'database_name' => 'e_journal',
            'tables' => $tables,
            'admin_count' => $adminCount,
            'jurnal_count' => $jurnalCount
        ]
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database setup failed: ' . $e->getMessage()
    ]);
}
?>
