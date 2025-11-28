<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashOut extends Model
{
    protected $fillable = [
        'account_id',
        'recipient_name',
        'recipient_account_number',
        'recipient_bank',
        'amount',
        'reference_number',
        'reference_note',
        'status',
        'processed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'processed_at' => 'datetime',
    ];

    /**
     * Get the account that made this cash out
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
