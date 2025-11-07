<?php
/**
 * Verify PIGGY MySQL Database Setup
 */

require_once __DIR__ . '/vendor/autoload.php';

// Load Laravel app
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🐷 PIGGY Banking System - Database Verification\n";
echo "==============================================\n\n";

try {
    // Test basic connection
    echo "1. Testing database connection...\n";
    DB::connection()->getPdo();
    echo "   ✅ Connected to MySQL successfully!\n\n";
    
    // Check tables
    echo "2. Checking database tables...\n";
    $tables = DB::select('SHOW TABLES');
    
    $tableNames = [];
    foreach ($tables as $table) {
        $tableArray = (array) $table;
        $tableName = reset($tableArray);
        $tableNames[] = $tableName;
        echo "   📋 $tableName\n";
    }
    echo "\n   ✅ Found " . count($tableNames) . " tables\n\n";
    
    // Check if our main tables exist
    $requiredTables = ['users', 'accounts', 'transactions', 'pending_registrations'];
    echo "3. Verifying required PIGGY tables...\n";
    
    foreach ($requiredTables as $table) {
        if (in_array($table, $tableNames)) {
            echo "   ✅ $table - OK\n";
        } else {
            echo "   ❌ $table - MISSING\n";
        }
    }
    
    // Check current data counts
    echo "\n4. Checking current data...\n";
    $userCount = DB::table('users')->count();
    $accountCount = DB::table('accounts')->count();
    $transactionCount = DB::table('transactions')->count();
    $pendingCount = DB::table('pending_registrations')->count();
    
    echo "   👥 Users: $userCount\n";
    echo "   🏦 Accounts: $accountCount\n";
    echo "   💰 Transactions: $transactionCount\n";
    echo "   📧 Pending Registrations: $pendingCount\n\n";
    
    echo "🎉 PIGGY MySQL database is ready!\n\n";
    echo "🚀 Next steps:\n";
    echo "   1. Start server: php artisan serve\n";
    echo "   2. Test registration: http://localhost:8000/simple-test\n";
    echo "   3. View status: http://localhost:8000/status\n\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>