<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class PendingRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'zip_code',
        'occupation',
        'monthly_income',
        'initial_deposit',
        'password_hash',
        'verification_token',
        'expires_at',
        'verified_at'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'expires_at' => 'datetime',
        'verified_at' => 'datetime',
        'monthly_income' => 'decimal:2',
        'initial_deposit' => 'decimal:2',
    ];

    /**
     * Generate verification URL for this pending registration
     */
    public function getVerificationUrl()
    {
        return URL::signedRoute('registration.verify', [
            'token' => $this->verification_token
        ], Carbon::now()->addHours(24));
    }

    /**
     * Check if the pending registration has expired
     */
    public function isExpired()
    {
        return $this->expires_at->isPast();
    }

    /**
     * Check if already verified
     */
    public function isVerified()
    {
        return !is_null($this->verified_at);
    }

    /**
     * Mark as verified
     */
    public function markAsVerified()
    {
        $this->verified_at = now();
        $this->save();
    }
}