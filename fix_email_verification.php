<?php

require_once __DIR__ . '/vendor/autoload.php';

// Boot Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

echo "🔍 Checking user email verification status...\n\n";

$user = User::where('email', 'juan.delacruz@email.com')->first();

if (!$user) {
    echo "❌ User not found!\n";
    exit;
}

echo "👤 User Details:\n";
echo "ID: {$user->id}\n";
echo "Name: {$user->first_name} {$user->last_name}\n";
echo "Email: {$user->email}\n";
echo "Email Verified At: " . ($user->email_verified_at ? $user->email_verified_at : 'NULL (not verified)') . "\n";
echo "Created At: {$user->created_at}\n\n";

if (!$user->email_verified_at) {
    echo "🔧 Fixing email verification...\n";
    $user->email_verified_at = now();
    $user->save();
    echo "✅ Email verification set to: {$user->email_verified_at}\n";
} else {
    echo "✅ Email is already verified!\n";
}

echo "\n🎯 User should now be able to login successfully!\n";