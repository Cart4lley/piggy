<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Transaction extends Model
{
    protected $fillable = [
        'account_id',
        'transaction_id',
        'type',
        'amount',
        'balance_before',
        'balance_after',
        'description',
        'reference_number',
        'status',
        'metadata'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2',
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Transaction types
    const TYPE_DEPOSIT = 'deposit';
    const TYPE_WITHDRAWAL = 'withdrawal';
    const TYPE_TRANSFER = 'transfer';
    const TYPE_PAYMENT = 'payment';
    const TYPE_INITIAL_DEPOSIT = 'initial_deposit';
    const TYPE_FEE = 'fee';
    const TYPE_INTEREST = 'interest';

    // Transaction statuses
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';
    const STATUS_CANCELLED = 'cancelled';

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Generate unique transaction ID
     */
    public static function generateTransactionId(): string
    {
        do {
            $transactionId = 'TXN' . date('Ymd') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('transaction_id', $transactionId)->exists());

        return $transactionId;
    }

    /**
     * Get formatted amount with currency
     */
    public function getFormattedAmountAttribute(): string
    {
        return '₱' . number_format($this->amount, 2);
    }

    /**
     * Get formatted balance before with currency
     */
    public function getFormattedBalanceBeforeAttribute(): string
    {
        return '₱' . number_format($this->balance_before, 2);
    }

    /**
     * Get formatted balance after with currency
     */
    public function getFormattedBalanceAfterAttribute(): string
    {
        return '₱' . number_format($this->balance_after, 2);
    }

    /**
     * Get transaction type with icon
     */
    public function getTypeWithIconAttribute(): string
    {
        $icons = [
            self::TYPE_DEPOSIT => '💰',
            self::TYPE_WITHDRAWAL => '💸',
            self::TYPE_TRANSFER => '🔄',
            self::TYPE_PAYMENT => '💳',
            self::TYPE_INITIAL_DEPOSIT => '🎉',
            self::TYPE_FEE => '📄',
            self::TYPE_INTEREST => '📈'
        ];

        return ($icons[$this->type] ?? '💰') . ' ' . ucfirst(str_replace('_', ' ', $this->type));
    }

    /**
     * Get transaction status with color class
     */
    public function getStatusClassAttribute(): string
    {
        return match($this->status) {
            self::STATUS_COMPLETED => 'success',
            self::STATUS_PENDING => 'warning',
            self::STATUS_FAILED => 'danger',
            self::STATUS_CANCELLED => 'secondary',
            default => 'primary'
        };
    }

    /**
     * Check if transaction is debit (money going out)
     */
    public function isDebit(): bool
    {
        return in_array($this->type, [
            self::TYPE_WITHDRAWAL,
            self::TYPE_PAYMENT,
            self::TYPE_FEE
        ]);
    }

    /**
     * Check if transaction is credit (money coming in)
     */
    public function isCredit(): bool
    {
        return in_array($this->type, [
            self::TYPE_DEPOSIT,
            self::TYPE_INITIAL_DEPOSIT,
            self::TYPE_INTEREST
        ]);
    }

    /**
     * Get transaction direction indicator
     */
    public function getDirectionAttribute(): string
    {
        if ($this->isCredit()) {
            return '+';
        } elseif ($this->isDebit()) {
            return '-';
        } else {
            return '~'; // For transfers and other neutral transactions
        }
    }

    /**
     * Scope for completed transactions
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope for pending transactions
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope for recent transactions
     */
    public function scopeRecent($query, int $days = 30)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days));
    }

    /**
     * Scope for deposits only
     */
    public function scopeDeposits($query)
    {
        return $query->where('type', self::TYPE_DEPOSIT);
    }

    /**
     * Scope for withdrawals only
     */
    public function scopeWithdrawals($query)
    {
        return $query->where('type', self::TYPE_WITHDRAWAL);
    }

    /**
     * Scope for transactions in date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Scope for transactions by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope for searching transactions
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('description', 'LIKE', "%{$search}%")
              ->orWhere('transaction_id', 'LIKE', "%{$search}%")
              ->orWhere('reference_number', 'LIKE', "%{$search}%");
        });
    }

    /**
     * Get human readable time difference
     */
    public function getTimeAgoAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Get transaction summary for display
     */
    public function getSummaryAttribute(): array
    {
        return [
            'id' => $this->transaction_id,
            'type' => ucfirst($this->type),
            'amount' => $this->formatted_amount,
            'direction' => $this->direction,
            'description' => $this->description,
            'date' => $this->created_at->format('M j, Y g:i A'),
            'status' => ucfirst($this->status),
            'balance_after' => $this->formatted_balance_after
        ];
    }

    /**
     * Check if transaction is a transfer (send or receive)
     */
    public function isTransfer(): bool
    {
        return $this->type === self::TYPE_TRANSFER || 
               (isset($this->metadata['transfer_type']) && 
                in_array($this->metadata['transfer_type'], ['send', 'receive']));
    }

    /**
     * Get transfer partner account number
     */
    public function getTransferPartnerAttribute(): ?string
    {
        if (!$this->isTransfer() || !$this->metadata) {
            return null;
        }

        return $this->metadata['recipient_account'] ?? $this->metadata['sender_account'] ?? null;
    }

    /**
     * Get transfer partner name
     */
    public function getTransferPartnerNameAttribute(): ?string
    {
        if (!$this->isTransfer() || !$this->metadata) {
            return null;
        }

        return $this->metadata['recipient_name'] ?? $this->metadata['sender_name'] ?? null;
    }

    /**
     * Get transfer reference number
     */
    public function getTransferReferenceAttribute(): ?string
    {
        if (!$this->isTransfer() || !$this->metadata) {
            return null;
        }

        return $this->metadata['reference'] ?? null;
    }

    /**
     * Get transfer direction (sent/received)
     */
    public function getTransferDirectionAttribute(): ?string
    {
        if (!$this->isTransfer() || !$this->metadata) {
            return null;
        }

        return $this->metadata['transfer_type'] ?? null;
    }

    /**
     * Scope for transfer transactions only
     */
    public function scopeTransfers($query)
    {
        return $query->where('type', self::TYPE_TRANSFER)
                    ->orWhere('metadata->transfer_type', 'send')
                    ->orWhere('metadata->transfer_type', 'receive');
    }

    /**
     * Scope for sent transfers only
     */
    public function scopeSentTransfers($query)
    {
        return $query->where('metadata->transfer_type', 'send');
    }

    /**
     * Scope for received transfers only  
     */
    public function scopeReceivedTransfers($query)
    {
        return $query->where('metadata->transfer_type', 'receive');
    }
}
