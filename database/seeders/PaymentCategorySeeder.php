<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Utilities',
                'slug' => 'utilities',
                'icon' => 'fas fa-lightbulb',
                'description' => 'Electricity, water, and other utility bills',
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Telecommunications',
                'slug' => 'telecommunications',
                'icon' => 'fas fa-phone',
                'description' => 'Mobile, internet, and telephone services',
                'is_active' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cable & Internet',
                'slug' => 'cable-internet',
                'icon' => 'fas fa-wifi',
                'description' => 'Cable TV and internet subscription payments',
                'is_active' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Credit Cards',
                'slug' => 'credit-cards',
                'icon' => 'fas fa-credit-card',
                'description' => 'Credit card bill payments',
                'is_active' => true,
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Loans',
                'slug' => 'loans',
                'icon' => 'fas fa-hand-holding-usd',
                'description' => 'Personal, home, and car loan payments',
                'is_active' => true,
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Insurance',
                'slug' => 'insurance',
                'icon' => 'fas fa-shield-alt',
                'description' => 'Health, life, and property insurance premiums',
                'is_active' => true,
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Government',
                'slug' => 'government',
                'icon' => 'fas fa-landmark',
                'description' => 'SSS, PhilHealth, Pag-IBIG, and other government payments',
                'is_active' => true,
                'sort_order' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
                'icon' => 'fas fa-graduation-cap',
                'description' => 'Tuition fees and school payments',
                'is_active' => true,
                'sort_order' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'icon' => 'fas fa-laptop',
                'description' => 'Electronics and appliance installment payments',
                'is_active' => true,
                'sort_order' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Real Estate',
                'slug' => 'real-estate',
                'icon' => 'fas fa-home',
                'description' => 'Property taxes and association dues',
                'is_active' => true,
                'sort_order' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('payment_categories')->insert($categories);
    }
}
