<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;

echo "=== CREATING NEW ACCOUNT: CARLOS MENDOZA ===\n\n";

try {
    // Create Carlos Mendoza - a new Filipino account holder
    $user = User::create([
        'name' => 'Carlos Mendoza',
        'email' => 'carlos.mendoza@email.com',
        'password' => Hash::make('password123'),
    ]);

    echo "✅ User created: {$user->name} (ID: {$user->id})\n";

    // Create savings account
    $account = Account::create([
        'user_id' => $user->id,
        'account_number' => Account::generateAccountNumber(),
        'account_type' => 'savings',
        'balance' => 3500.00,
        'available_balance' => 3150.00, // 90% available
        'status' => 'active',
        'branch_code' => '001001'
    ]);

    echo "✅ Account created: {$account->account_number} (savings)\n";
    echo "💰 Initial Balance: $" . number_format(3500, 2) . "\n";

    // Create some initial transactions to make it realistic
    $transactions = [
        [
            'type' => 'deposit',
            'amount' => 5000.00,
            'description' => 'Initial Deposit',
            'days_ago' => 30
        ],
        [
            'type' => 'withdrawal',
            'amount' => 800.00,
            'description' => 'ATM Withdrawal',
            'days_ago' => 15
        ],
        [
            'type' => 'deposit',
            'amount' => 1200.00,
            'description' => 'Salary Deposit',
            'days_ago' => 7
        ],
        [
            'type' => 'withdrawal',
            'amount' => 300.00,
            'description' => 'Bill Payment',
            'days_ago' => 3
        ],
        [
            'type' => 'transfer',
            'amount' => 1600.00,
            'description' => 'Transfer Out',
            'days_ago' => 1
        ]
    ];

    $currentBalance = 0;
    foreach ($transactions as $txn) {
        $balanceBefore = $currentBalance;
        
        if ($txn['type'] === 'deposit') {
            $currentBalance += $txn['amount'];
        } else {
            $currentBalance -= $txn['amount'];
        }

        Transaction::create([
            'account_id' => $account->id,
            'transaction_id' => Transaction::generateTransactionId(),
            'type' => $txn['type'],
            'amount' => $txn['amount'],
            'balance_before' => $balanceBefore,
            'balance_after' => $currentBalance,
            'description' => $txn['description'],
            'reference_number' => 'REF' . rand(100000, 999999),
            'status' => 'completed',
            'created_at' => now()->subDays($txn['days_ago'])
        ]);

        echo "📝 Transaction: {$txn['description']} - $" . number_format($txn['amount'], 2) . "\n";
    }

    // Update final balance
    $account->update(['balance' => $currentBalance]);

    echo "\n🎉 Carlos Mendoza's account successfully created!\n\n";

    // Show summary
    echo "=== ACCOUNT SUMMARY ===\n";
    echo "👤 User: Carlos Mendoza\n";
    echo "📧 Email: carlos.mendoza@email.com\n";
    echo "💳 Account Number: {$account->account_number}\n";
    echo "🏦 Account Type: Savings\n";
    echo "💰 Final Balance: $" . number_format($currentBalance, 2) . "\n";
    echo "✅ Status: Active\n";
    echo "🔑 Login Password: password123\n";

} catch (Exception $e) {
    echo "❌ Error creating account: " . $e->getMessage() . "\n";
    exit(1);
}