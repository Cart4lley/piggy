<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('phone', 20)->nullable()->after('email');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->enum('gender', ['male', 'female', 'other', 'prefer-not-to-say'])->nullable()->after('date_of_birth');
            $table->text('address')->nullable()->after('gender');
            $table->string('city', 100)->nullable()->after('address');
            $table->string('zip_code', 10)->nullable()->after('city');
            $table->string('occupation', 100)->nullable()->after('zip_code');
            $table->decimal('monthly_income', 15, 2)->nullable()->after('occupation');
            $table->decimal('initial_deposit', 15, 2)->nullable()->after('monthly_income');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
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
                'initial_deposit'
            ]);
        });
    }
};
