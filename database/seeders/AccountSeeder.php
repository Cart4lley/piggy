<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create dummy users
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike.johnson@example.com',
                'password' => bcrypt('password123'),
            ]
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);

            // Create primary savings account
            $savingsAccount = Account::create([
                'user_id' => $user->id,
                'account_number' => Account::generateAccountNumber(),
                'account_type' => 'savings',
                'balance' => rand(1000, 50000),
                'available_balance' => rand(800, 45000),
                'status' => 'active',
                'branch_code' => '001001'
            ]);

            // Create checking account
            $checkingAccount = Account::create([
                'user_id' => $user->id,
                'account_number' => Account::generateAccountNumber(),
                'account_type' => 'checking',
                'balance' => rand(500, 15000),
                'available_balance' => rand(400, 12000),
                'status' => 'active',
                'branch_code' => '001001'
            ]);

            // Create dummy transactions for savings account
            $this->createDummyTransactions($savingsAccount);
            $this->createDummyTransactions($checkingAccount);
        }
    }

    private function createDummyTransactions(Account $account)
    {
        $transactionTypes = ['deposit', 'withdrawal', 'transfer', 'payment'];
        $descriptions = [
            'deposit' => ['Salary Deposit', 'Cash Deposit', 'Transfer In', 'Refund'],
            'withdrawal' => ['ATM Withdrawal', 'Cash Withdrawal', 'Transfer Out'],
            'transfer' => ['Online Transfer', 'Wire Transfer', 'Internal Transfer'],
            'payment' => ['Bill Payment', 'Online Payment', 'Merchant Payment']
        ];

        $currentBalance = $account->balance;

        for ($i = 0; $i < 20; $i++) {
            $type = $transactionTypes[array_rand($transactionTypes)];
            $amount = rand(50, 2000);
            
            if ($type === 'withdrawal' || $type === 'payment') {
                $amount = -$amount;
            }

            $balanceBefore = $currentBalance;
            $currentBalance += $amount;
            
            Transaction::create([
                'account_id' => $account->id,
                'transaction_id' => Transaction::generateTransactionId(),
                'type' => $type,
                'amount' => abs($amount),
                'balance_before' => $balanceBefore,
                'balance_after' => $currentBalance,
                'description' => $descriptions[$type][array_rand($descriptions[$type])],
                'reference_number' => 'REF' . rand(100000, 999999),
                'status' => 'completed',
                'created_at' => now()->subDays(rand(1, 30))
            ]);
        }

        // Update account balance to final calculated balance
        $account->update(['balance' => $currentBalance]);
    }
}
