<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Account extends Model
{
    protected $fillable = [
        'user_id',
        'account_number',
        'account_type',
        'balance',
        'available_balance',
        'status',
        'branch_code'
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'available_balance' => 'decimal:2'
    ];

    // Account types
    const TYPE_SAVINGS = 'savings';
    const TYPE_CHECKING = 'checking';
    const TYPE_CREDIT = 'credit';

    // Account statuses
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_FROZEN = 'frozen';
    const STATUS_CLOSED = 'closed';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Generate unique account number with PIGGY prefix
     */
    public static function generateAccountNumber(): string
    {
        do {
            $accountNumber = 'PIGGY' . str_pad(mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);
        } while (self::where('account_number', $accountNumber)->exists());

        return $accountNumber;
    }

    /**
     * Deposit money to account with transaction record
     */
    public function deposit(float $amount, string $description = 'Deposit', array $metadata = []): Transaction
    {
        return DB::transaction(function () use ($amount, $description, $metadata) {
            $balanceBefore = $this->balance;
            $balanceAfter = $balanceBefore + $amount;

            // Update account balance
            $this->update([
                'balance' => $balanceAfter,
                'available_balance' => $balanceAfter
            ]);

            // Create transaction record
            return Transaction::create([
                'account_id' => $this->id,
                'transaction_id' => Transaction::generateTransactionId(),
                'type' => Transaction::TYPE_DEPOSIT,
                'amount' => $amount,
                'balance_before' => $balanceBefore,
                'balance_after' => $balanceAfter,
                'description' => $description,
                'status' => Transaction::STATUS_COMPLETED,
                'metadata' => $metadata
            ]);
        });
    }

    /**
     * Withdraw money from account with transaction record
     */
    public function withdraw(float $amount, string $description = 'Withdrawal', array $metadata = []): Transaction
    {
        if ($this->balance < $amount) {
            throw new \Exception('Insufficient funds');
        }

        return DB::transaction(function () use ($amount, $description, $metadata) {
            $balanceBefore = $this->balance;
            $balanceAfter = $balanceBefore - $amount;

            // Update account balance
            $this->update([
                'balance' => $balanceAfter,
                'available_balance' => $balanceAfter
            ]);

            // Create transaction record
            return Transaction::create([
                'account_id' => $this->id,
                'transaction_id' => Transaction::generateTransactionId(),
                'type' => Transaction::TYPE_WITHDRAWAL,
                'amount' => $amount,
                'balance_before' => $balanceBefore,
                'balance_after' => $balanceAfter,
                'description' => $description,
                'status' => Transaction::STATUS_COMPLETED,
                'metadata' => $metadata
            ]);
        });
    }

    /**
     * Transfer money to another account
     */
    public function transferTo(Account $toAccount, float $amount, string $description = 'Transfer'): array
    {
        if ($this->balance < $amount) {
            throw new \Exception('Insufficient funds');
        }

        return DB::transaction(function () use ($toAccount, $amount, $description) {
            // Create withdrawal transaction for sender
            $withdrawalTransaction = $this->withdraw($amount, "Transfer to {$toAccount->account_number}: {$description}", [
                'transfer_type' => 'outgoing',
                'recipient_account' => $toAccount->account_number,
                'recipient_name' => $toAccount->user->name
            ]);

            // Create deposit transaction for recipient
            $depositTransaction = $toAccount->deposit($amount, "Transfer from {$this->account_number}: {$description}", [
                'transfer_type' => 'incoming',
                'sender_account' => $this->account_number,
                'sender_name' => $this->user->name
            ]);

            return [
                'withdrawal' => $withdrawalTransaction,
                'deposit' => $depositTransaction
            ];
        });
    }

    /**
     * Get formatted balance
     */
    public function getFormattedBalanceAttribute(): string
    {
        return '₱' . number_format($this->balance, 2);
    }

    /**
     * Get recent transactions
     */
    public function getRecentTransactions(int $limit = 10)
    {
        return $this->transactions()->orderBy('created_at', 'desc')->take($limit)->get();
    }

    /**
     * Check if account is active
     */
    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * Get account summary
     */
    public function getSummary(): array
    {
        return [
            'account_number' => $this->account_number,
            'account_type' => ucfirst($this->account_type),
            'balance' => $this->formatted_balance,
            'status' => ucfirst($this->status),
            'transaction_count' => $this->transactions()->count(),
            'last_transaction' => $this->transactions()->latest()->first()?->created_at?->diffForHumans(),
        ];
    }
}
