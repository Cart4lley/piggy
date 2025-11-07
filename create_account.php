<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;

echo "=== CREATING NEW ACCOUNT ===\n\n";

// Get user input for new account
echo "Enter new user details:\n";
echo "Name: ";
$name = trim(fgets(STDIN));

echo "Email: ";
$email = trim(fgets(STDIN));

// Check if email already exists
if (User::where('email', $email)->exists()) {
    echo "❌ Email already exists! Please use a different email.\n";
    exit(1);
}

echo "Password: ";
$password = trim(fgets(STDIN));

echo "Account Type (savings/checking) [savings]: ";
$accountType = trim(fgets(STDIN));
if (empty($accountType)) {
    $accountType = 'savings';
}

echo "Initial Balance [1000]: ";
$balance = trim(fgets(STDIN));
if (empty($balance) || !is_numeric($balance)) {
    $balance = 1000;
} else {
    $balance = floatval($balance);
}

echo "\n--- Creating Account ---\n";

try {
    // Create the user
    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($password),
    ]);

    echo "✅ User created: {$user->name} (ID: {$user->id})\n";

    // Create the account
    $account = Account::create([
        'user_id' => $user->id,
        'account_number' => Account::generateAccountNumber(),
        'account_type' => $accountType,
        'balance' => $balance,
        'available_balance' => $balance * 0.9, // 90% available
        'status' => 'active',
        'branch_code' => '001001'
    ]);

    echo "✅ Account created: {$account->account_number} ({$account->account_type})\n";
    echo "💰 Initial Balance: $" . number_format($balance, 2) . "\n";
    echo "\n🎉 New account successfully created!\n\n";

    // Show summary
    echo "=== ACCOUNT SUMMARY ===\n";
    echo "👤 User: {$user->name}\n";
    echo "📧 Email: {$user->email}\n";
    echo "💳 Account Number: {$account->account_number}\n";
    echo "🏦 Account Type: " . ucfirst($account->account_type) . "\n";
    echo "💰 Balance: $" . number_format($account->balance, 2) . "\n";
    echo "✅ Status: " . ucfirst($account->status) . "\n";

} catch (Exception $e) {
    echo "❌ Error creating account: " . $e->getMessage() . "\n";
    exit(1);
}