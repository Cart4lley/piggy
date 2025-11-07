<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Account;

echo "=== CURRENT USERS AND ACCOUNTS ===\n\n";

$users = User::with('accounts')->get();

foreach ($users as $user) {
    echo "👤 User: {$user->name} ({$user->email})\n";
    
    foreach ($user->accounts as $account) {
        echo "   💳 Account: {$account->account_number} ({$account->account_type})\n";
        echo "      Balance: $" . number_format($account->balance, 2) . "\n";
        echo "      Status: {$account->status}\n\n";
    }
}

echo "Total Users: " . $users->count() . "\n";
echo "Total Accounts: " . Account::count() . "\n";