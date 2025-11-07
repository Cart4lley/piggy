<?php
/**
 * PIGGY Banking System - Database Creator
 * This script creates the MySQL database for PIGGY
 */

echo "🐷 PIGGY Banking System - MySQL Database Setup\n";
echo "===============================================\n\n";

// Database connection settings
$host = '127.0.0.1';
$port = 3306;
$username = 'root';
$password = ''; // Default XAMPP has no password

echo "1. Connecting to MySQL server...\n";

try {
    // Connect to MySQL server (without specific database)
    $dsn = "mysql:host=$host;port=$port;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    echo "   ✅ Connected to MySQL server successfully!\n\n";
    
    echo "2. Creating 'piggy_bank' database...\n";
    
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS piggy_bank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $pdo->exec($sql);
    
    echo "   ✅ Database 'piggy_bank' created successfully!\n\n";
    
    // Test connection to the new database
    echo "3. Testing connection to piggy_bank database...\n";
    $dsn_with_db = "mysql:host=$host;port=$port;dbname=piggy_bank;charset=utf8mb4";
    $pdo_test = new PDO($dsn_with_db, $username, $password);
    
    echo "   ✅ Connection to piggy_bank database successful!\n\n";
    
    echo "🎉 Database setup complete!\n\n";
    echo "📋 Database Details:\n";
    echo "   Host: $host:$port\n";
    echo "   Database: piggy_bank\n";
    echo "   Username: $username\n";
    echo "   Password: " . (empty($password) ? "(no password)" : "(password set)") . "\n\n";
    
    echo "🚀 Next steps:\n";
    echo "   1. Run: php artisan migrate:fresh\n";
    echo "   2. Run: php artisan serve\n";
    echo "   3. Visit: http://localhost:8000/status\n\n";
    
} catch (PDOException $e) {
    echo "   ❌ Error: " . $e->getMessage() . "\n\n";
    echo "💡 Troubleshooting:\n";
    echo "   • Make sure MySQL is running (check XAMPP control panel)\n";
    echo "   • Check if username/password is correct\n";
    echo "   • Try installing XAMPP: https://www.apachefriends.org/\n\n";
    exit(1);
}
?>