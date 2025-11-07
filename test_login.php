<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Boot Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🔐 Testing Login System...\n\n";

// Test credentials
$testCredentials = [
    ['email' => 'juan.delacruz@email.com', 'password' => 'password123'],
    ['username' => 'juan.delacruz', 'password' => 'password123']
];

foreach ($testCredentials as $index => $creds) {
    $loginType = isset($creds['email']) ? 'Email' : 'Username';
    $loginValue = $creds['email'] ?? $creds['username'];
    
    echo "🧪 Test " . ($index + 1) . ": Login with {$loginType}\n";
    echo "Credential: {$loginValue}\n";
    echo "Password: {$creds['password']}\n";
    
    // Find user
    if (isset($creds['email'])) {
        $user = User::where('email', $creds['email'])->first();
    } else {
        $user = User::where('username', $creds['username'])->first();
    }
    
    if (!$user) {
        echo "❌ User not found!\n\n";
        continue;
    }
    
    echo "✅ User found: {$user->first_name} {$user->last_name}\n";
    echo "Email verified: " . ($user->email_verified_at ? 'Yes' : 'No') . "\n";
    
    // Test password
    if (Hash::check($creds['password'], $user->password)) {
        echo "✅ Password matches!\n";
        
        // Test authentication attempt
        $loginField = isset($creds['email']) ? 'email' : 'username';
        $authCreds = [$loginField => $loginValue, 'password' => $creds['password']];
        
        if (Auth::attempt($authCreds)) {
            echo "✅ Authentication successful!\n";
            echo "Authenticated user: " . Auth::user()->email . "\n";
            
            // Check email verification
            if (Auth::user()->hasVerifiedEmail()) {
                echo "✅ Email is verified - Login would succeed!\n";
            } else {
                echo "⚠️ Email not verified - Would redirect to verification page\n";
            }
            
            // Logout for next test
            Auth::logout();
        } else {
            echo "❌ Authentication failed!\n";
        }
    } else {
        echo "❌ Password does not match!\n";
    }
    
    echo "\n" . str_repeat('-', 50) . "\n\n";
}

// Check user account details
echo "📊 User Account Details:\n";
$user = User::where('email', 'juan.delacruz@email.com')->first();
if ($user) {
    echo "ID: {$user->id}\n";
    echo "Name: {$user->first_name} {$user->last_name}\n";
    echo "Email: {$user->email}\n";
    echo "Username: {$user->username}\n";
    echo "Email Verified At: " . ($user->email_verified_at ? $user->email_verified_at : 'Not verified') . "\n";
    echo "Created At: {$user->created_at}\n";
    
    if ($user->account) {
        echo "\n💰 Account Info:\n";
        echo "Account Number: {$user->account->account_number}\n";
        echo "Balance: ₱" . number_format($user->account->balance, 2) . "\n";
        echo "Status: {$user->account->status}\n";
    } else {
        echo "\n❌ No bank account found!\n";
    }
} else {
    echo "❌ User not found!\n";
}

echo "\n🌐 Ready to test at: http://127.0.0.1:8000/signin\n";
echo "Use either:\n";
echo "- Email: juan.delacruz@email.com\n";
echo "- Username: juan.delacruz\n";
echo "- Password: password123\n";