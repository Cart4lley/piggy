<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanupExpiredRegistrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registration:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up expired pending registrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredCount = \App\Models\PendingRegistration::where('expires_at', '<', now())
            ->where('verified_at', null)
            ->delete();

        $this->info("Cleaned up {$expiredCount} expired pending registrations.");
        
        return 0;
    }
}
