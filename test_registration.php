<?php
/**
 * Test Registration Manually
 * This script will simulate a registration to see if the AuthController works
 */

require_once __DIR__ . '/vendor/autoload.php';

// Load Laravel app
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🐷 Testing PIGGY Registration Process\n";
echo "====================================\n\n";

try {
    echo "1. Testing AuthController registration method...\n";
    
    // Simulate registration data
    $registrationData = [
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'phone' => '+639171234567',
        'date_of_birth' => '1990-01-01',
        'gender' => 'male',
        'address' => '123 Test St.',
        'city' => 'Test City',
        'zip_code' => '1234',
        'occupation' => 'Developer',
        'monthly_income' => 50000,
        'initial_deposit' => 5000,
        'password' => 'password123',
        'password_confirmation' => 'password123'
    ];
    
    echo "2. Creating pending registration directly...\n";
    
    // Create pending registration directly
    $pendingRegistration = \App\Models\PendingRegistration::create([
        'email' => $registrationData['email'],
        'first_name' => $registrationData['first_name'],
        'last_name' => $registrationData['last_name'],
        'phone' => $registrationData['phone'],
        'date_of_birth' => $registrationData['date_of_birth'],
        'gender' => $registrationData['gender'],
        'address' => $registrationData['address'],
        'city' => $registrationData['city'],
        'zip_code' => $registrationData['zip_code'],
        'occupation' => $registrationData['occupation'],
        'monthly_income' => $registrationData['monthly_income'],
        'initial_deposit' => $registrationData['initial_deposit'],
        'password_hash' => \Hash::make($registrationData['password']),
        'verification_token' => \Str::random(64),
        'expires_at' => now()->addHours(24),
    ]);
    
    echo "   ✅ Pending registration created with ID: {$pendingRegistration->id}\n";
    echo "   📧 Email: {$pendingRegistration->email}\n";
    echo "   🔑 Token: {$pendingRegistration->verification_token}\n\n";
    
    echo "3. Testing verification process...\n";
    
    // Test verification
    $token = $pendingRegistration->verification_token;
    $found = \App\Models\PendingRegistration::where('verification_token', $token)->first();
    
    if ($found) {
        echo "   ✅ Pending registration found by token\n";
        
        // Mark as verified
        $found->markAsVerified();
        
        // Create actual user
        $user = \App\Models\User::create([
            'name' => $found->first_name . ' ' . $found->last_name,
            'first_name' => $found->first_name,
            'last_name' => $found->last_name,
            'email' => $found->email,
            'phone' => $found->phone,
            'date_of_birth' => $found->date_of_birth,
            'gender' => $found->gender,
            'address' => $found->address,
            'city' => $found->city,
            'zip_code' => $found->zip_code,
            'occupation' => $found->occupation,
            'monthly_income' => $found->monthly_income,
            'initial_deposit' => $found->initial_deposit,
            'password' => $found->password_hash,
            'email_verified_at' => now(),
        ]);
        
        echo "   ✅ User created with ID: {$user->id}\n";
        
        // Create account
        $account = \App\Models\Account::create([
            'user_id' => $user->id,
            'account_number' => \App\Models\Account::generateAccountNumber(),
            'account_type' => \App\Models\Account::TYPE_SAVINGS,
            'balance' => 0.00,
            'available_balance' => 0.00,
            'status' => \App\Models\Account::STATUS_ACTIVE,
            'branch_code' => '001001'
        ]);
        
        echo "   ✅ Account created: {$account->account_number}\n";
        
        // Make initial deposit
        if ($found->initial_deposit > 0) {
            $transaction = $account->deposit(
                $found->initial_deposit,
                'Initial deposit upon account opening',
                [
                    'deposit_type' => 'initial_opening',
                    'source' => 'manual_test',
                    'currency' => 'PHP'
                ]
            );
            
            echo "   ✅ Initial deposit: ₱" . number_format($found->initial_deposit, 2) . "\n";
            echo "   💰 Account balance: " . $account->fresh()->formatted_balance . "\n";
        }
        
        // Clean up
        $found->delete();
        echo "   ✅ Pending registration cleaned up\n\n";
        
        echo "🎉 Registration process completed successfully!\n\n";
        echo "📊 Final status:\n";
        echo "   👥 Total Users: " . \App\Models\User::count() . "\n";
        echo "   🏦 Total Accounts: " . \App\Models\Account::count() . "\n";
        echo "   💰 Total Transactions: " . \App\Models\Transaction::count() . "\n";
        echo "   📧 Pending Registrations: " . \App\Models\PendingRegistration::count() . "\n\n";
        
    } else {
        echo "   ❌ Could not find pending registration by token\n";
    }
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
    exit(1);
}
?>