<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// Boot Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🐷 PIGGY Bank - Creating Active Account...\n\n";

// Account details
$userData = [
    'first_name' => 'Juan',
    'last_name' => 'Dela Cruz',
    'email' => 'juan.delacruz@email.com',
    'phone' => '+63 917 123 4567',
    'address' => '123 Rizal Street, Barangay San Jose',
    'city' => 'Manila',
    'zip_code' => '1000',
    'date_of_birth' => '1990-05-15',
    'gender' => 'male',
    'occupation' => 'Software Engineer',
    'monthly_income' => 75000,
    'username' => 'juan.delacruz',
    'password' => 'password123', // Will be hashed
    'email_verified_at' => now(),
];

$initialDeposit = 10000.00; // ₱10,000 initial deposit

echo "📋 Account Details:\n";
echo "Name: {$userData['first_name']} {$userData['last_name']}\n";
echo "Email: {$userData['email']}\n";
echo "Username: {$userData['username']}\n";
echo "Password: {$userData['password']}\n";
echo "Initial Deposit: ₱" . number_format($initialDeposit, 2) . "\n";
echo "Email Verified: Yes (Active Account)\n\n";

try {
    DB::beginTransaction();
    
    // Check if user already exists
    $existingUser = User::where('email', $userData['email'])->first();
    if ($existingUser) {
        echo "❌ User with email {$userData['email']} already exists!\n";
        echo "User ID: {$existingUser->id}\n";
        if ($existingUser->account) {
            echo "Account Number: {$existingUser->account->account_number}\n";
            echo "Balance: ₱" . number_format($existingUser->account->balance, 2) . "\n";
        }
        exit;
    }
    
    // Create the user
    $user = User::create([
        'name' => $userData['first_name'] . ' ' . $userData['last_name'],
        'first_name' => $userData['first_name'],
        'last_name' => $userData['last_name'],
        'email' => $userData['email'],
        'phone' => $userData['phone'],
        'address' => $userData['address'],
        'city' => $userData['city'],
        'zip_code' => $userData['zip_code'],
        'date_of_birth' => $userData['date_of_birth'],
        'gender' => $userData['gender'],
        'occupation' => $userData['occupation'],
        'monthly_income' => $userData['monthly_income'],
        'username' => $userData['username'],
        'password' => Hash::make($userData['password']),
        'email_verified_at' => $userData['email_verified_at'],
    ]);
    
    echo "✅ User created successfully!\n";
    echo "User ID: {$user->id}\n";
    
    // Create the bank account
    $account = Account::create([
        'user_id' => $user->id,
        'account_number' => 'PIGGY' . str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT),
        'account_type' => 'savings',
        'balance' => 0, // Will be updated by the deposit
        'currency' => 'PHP',
        'status' => 'active',
        'interest_rate' => 2.5,
        'minimum_balance' => 500.00,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    
    echo "✅ Bank account created successfully!\n";
    echo "Account Number: {$account->account_number}\n";
    
    // Make the initial deposit
    if ($initialDeposit > 0) {
        $account->deposit(
            $initialDeposit,
            'Initial deposit upon account opening',
            [
                'deposit_type' => 'initial_opening',
                'source' => 'manual_creation',
                'currency' => 'PHP',
                'created_by' => 'system'
            ]
        );
        
        echo "✅ Initial deposit completed!\n";
        echo "Deposit Amount: ₱" . number_format($initialDeposit, 2) . "\n";
        echo "Current Balance: ₱" . number_format($account->fresh()->balance, 2) . "\n";
    }
    
    // Get transaction details
    $transaction = Transaction::where('account_id', $account->id)->first();
    if ($transaction) {
        echo "✅ Transaction recorded!\n";
        echo "Transaction ID: {$transaction->id}\n";
        echo "Transaction Type: {$transaction->type}\n";
        echo "Amount: ₱" . number_format($transaction->amount, 2) . "\n";
        echo "Description: {$transaction->description}\n";
    }
    
    DB::commit();
    
    echo "\n🎉 SUCCESS! Active PIGGY Bank account created!\n\n";
    
    echo "🔐 Login Credentials:\n";
    echo "Email/Username: {$userData['email']} or {$userData['username']}\n";
    echo "Password: {$userData['password']}\n\n";
    
    echo "💰 Account Summary:\n";
    echo "Account Number: {$account->account_number}\n";
    echo "Account Type: " . ucfirst($account->account_type) . "\n";
    echo "Status: " . ucfirst($account->status) . "\n";
    echo "Balance: ₱" . number_format($account->fresh()->balance, 2) . "\n";
    echo "Interest Rate: {$account->interest_rate}%\n";
    echo "Minimum Balance: ₱" . number_format($account->minimum_balance, 2) . "\n";
    echo "Currency: {$account->currency}\n\n";
    
    echo "📊 Database Summary:\n";
    echo "Total Users: " . User::count() . "\n";
    echo "Total Accounts: " . Account::count() . "\n";
    echo "Total Transactions: " . Transaction::count() . "\n";
    echo "Total Balance in System: ₱" . number_format(Account::sum('balance'), 2) . "\n\n";
    
    echo "🌐 You can now:\n";
    echo "1. Sign in at: http://127.0.0.1:8000/signin\n";
    echo "2. Use email: {$userData['email']}\n";
    echo "3. Use password: {$userData['password']}\n";
    echo "4. Access your dashboard with ₱" . number_format($initialDeposit, 2) . " balance\n";
    
} catch (Exception $e) {
    DB::rollBack();
    echo "❌ Error creating account!\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    
    if (method_exists($e, 'getSql')) {
        echo "SQL: " . $e->getSql() . "\n";
    }
}