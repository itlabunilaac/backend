<?php

echo "🔍 PHP Extensions Check\n";
echo "======================\n\n";

echo "📊 PHP Version: " . PHP_VERSION . "\n\n";

// Check for database extensions
$db_extensions = ['pdo', 'pdo_mysql', 'pdo_sqlite', 'mysqli', 'sqlite3'];

echo "💾 Database Extensions:\n";
foreach ($db_extensions as $ext) {
    $status = extension_loaded($ext) ? '✅' : '❌';
    echo "  $status $ext\n";
}

echo "\n📋 All loaded extensions:\n";
$extensions = get_loaded_extensions();
sort($extensions);
foreach ($extensions as $ext) {
    echo "  - $ext\n";
}
