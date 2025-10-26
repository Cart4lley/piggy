<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\User;

// Boot Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🔧 Updating existing Juan account with username...\n";

$user = User::where('email', 'juan.delacruz@email.com')->first();
if ($user) {
    $user->username = 'juan.delacruz';
    $user->save();
    echo "✅ Updated Juan's account with username: juan.delacruz\n\n";
} else {
    echo "❌ Juan's account not found\n\n";
}

echo "🏦 Creating Additional Test Accounts for Money Transfer Demo...\n\n";

use App\Models\Account;
use Illuminate\Support\Facades\Hash;

$testAccounts = [
    [
        'name' => 'Maria Santos',
        'first_name' => 'Maria',
        'last_name' => 'Santos',
        'email' => 'maria.santos@email.com',
        'username' => 'maria.santos',
        'phone' => '+639171234567',
        'initial_balance' => 5000.00
    ],
    [
        'name' => 'Jose Rizal',
        'first_name' => 'Jose',
        'last_name' => 'Rizal',
        'email' => 'jose.rizal@email.com',
        'username' => 'jose.rizal',
        'phone' => '+639181234567',
        'initial_balance' => 8500.00
    ],
    [
        'name' => 'Anna Reyes',
        'first_name' => 'Anna',
        'last_name' => 'Reyes',
        'email' => 'anna.reyes@email.com',
        'username' => 'anna.reyes',
        'phone' => '+639191234567',
        'initial_balance' => 2750.00
    ]
];

foreach ($testAccounts as $index => $accountData) {
    echo "👤 Creating account " . ($index + 1) . ": {$accountData['name']}\n";
    
    // Check if user already exists
    $existingUser = User::where('email', $accountData['email'])->first();
    if ($existingUser) {
        echo "   ⚠️ User already exists, skipping...\n";
        continue;
    }
    
    try {
        // Create user
        $user = User::create([
            'name' => $accountData['name'],
            'first_name' => $accountData['first_name'],
            'last_name' => $accountData['last_name'],
            'email' => $accountData['email'],
            'username' => $accountData['username'],
            'phone' => $accountData['phone'],
            'date_of_birth' => '1990-01-01',
            'gender' => 'other',
            'address' => '123 Sample Street',
            'city' => 'Manila',
            'zip_code' => '1000',
            'occupation' => 'Test Account',
            'monthly_income' => 50000,
            'initial_deposit' => $accountData['initial_balance'],
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        echo "   ✅ User created with ID: {$user->id}\n";

        // Create bank account
        $account = Account::create([
            'user_id' => $user->id,
            'account_number' => Account::generateAccountNumber(),
            'account_type' => Account::TYPE_SAVINGS,
            'balance' => 0.00,
            'available_balance' => 0.00,
            'status' => Account::STATUS_ACTIVE,
            'branch_code' => '001001'
        ]);

        echo "   💳 Account created: {$account->account_number}\n";

        // Make initial deposit
        if ($accountData['initial_balance'] > 0) {
            $account->deposit(
                $accountData['initial_balance'], 
                'Initial account opening deposit',
                [
                    'deposit_type' => 'initial_opening',
                    'source' => 'account_creation',
                    'currency' => 'PHP'
                ]
            );
            echo "   💰 Initial deposit: ₱" . number_format($accountData['initial_balance'], 2) . "\n";
        }

        echo "   🎉 Account setup complete!\n\n";

    } catch (\Exception $e) {
        echo "   ❌ Error creating account: " . $e->getMessage() . "\n\n";
    }
}

echo "📊 Summary of All Test Accounts:\n";
echo str_repeat('=', 80) . "\n";
printf("%-20s %-15s %-25s %-12s\n", "Name", "Account Number", "Email/Username", "Balance");
echo str_repeat('=', 80) . "\n";

$allUsers = User::with('account')->whereIn('email', [
    'juan.delacruz@email.com',
    'maria.santos@email.com', 
    'jose.rizal@email.com',
    'anna.reyes@email.com'
])->get();

foreach ($allUsers as $user) {
    if ($user->account) {
        printf("%-20s %-15s %-25s ₱%-11s\n", 
            $user->name, 
            $user->account->account_number,
            $user->username ?: $user->email,
            number_format($user->account->balance, 2)
        );
    }
}

echo str_repeat('=', 80) . "\n";
echo "\n🚀 Ready to test money transfers!\n\n";

echo "💳 Test Account Details:\n";
echo "Login Credentials (all accounts): password123\n\n";

foreach ($allUsers as $user) {
    if ($user->account) {
        echo "🏦 {$user->name}\n";
        echo "   Account: {$user->account->account_number}\n";
        echo "   Username: {$user->username}\n";
        echo "   Balance: ₱" . number_format($user->account->balance, 2) . "\n\n";
    }
}

echo "📋 How to test transfers:\n";
echo "1. Login at: http://127.0.0.1:8000/signin\n";
echo "2. Use any username above with password: password123\n";  
echo "3. Click 'Send Money' button on dashboard\n";
echo "4. Enter recipient's account number (from list above)\n";
echo "5. Enter amount and send!\n";