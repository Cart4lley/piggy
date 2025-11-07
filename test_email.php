<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\PendingRegistration;
use App\Notifications\PendingRegistrationVerification;
use Illuminate\Support\Facades\Notification;

// Boot Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🔍 Testing Email System...\n\n";

// Check if there are any pending registrations
$pendingRegistrations = PendingRegistration::latest()->take(3)->get();

if ($pendingRegistrations->isEmpty()) {
    echo "❌ No pending registrations found to test email with.\n";
    echo "Please register first, then run this test.\n";
    exit;
}

echo "📋 Found " . $pendingRegistrations->count() . " pending registration(s):\n";
foreach ($pendingRegistrations as $pending) {
    echo "  - Email: {$pending->email}\n";
    echo "  - Name: {$pending->first_name} {$pending->last_name}\n";
    echo "  - Created: {$pending->created_at}\n\n";
}

// Test sending email to the latest pending registration
$latest = $pendingRegistrations->first();
echo "🔔 Testing email notification to: {$latest->email}\n";

try {
    // Clear the log file first to see only our test email
    $logFile = __DIR__ . '/storage/logs/laravel.log';
    if (file_exists($logFile)) {
        file_put_contents($logFile, "=== EMAIL TEST START ===\n");
    }
    
    // Send the notification
    Notification::route('mail', $latest->email)
        ->notify(new PendingRegistrationVerification($latest));
    
    echo "✅ Email notification sent successfully!\n";
    echo "📁 Check the log file: storage/logs/laravel.log\n\n";
    
    // Wait a moment for the log to write
    sleep(1);
    
    // Try to read the log
    if (file_exists($logFile)) {
        echo "📄 Recent log contents:\n";
        echo "======================\n";
        $logContents = file_get_contents($logFile);
        echo $logContents;
    } else {
        echo "❌ Log file not found at: $logFile\n";
    }
    
} catch (Exception $e) {
    echo "❌ Email sending failed!\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "\n🔍 Checking mail configuration:\n";
echo "MAIL_MAILER: " . config('mail.default') . "\n";
echo "MAIL_FROM_ADDRESS: " . config('mail.from.address') . "\n";
echo "MAIL_FROM_NAME: " . config('mail.from.name') . "\n";