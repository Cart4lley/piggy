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
        Schema::create('pending_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone', 20);
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other', 'prefer-not-to-say'])->nullable();
            $table->text('address');
            $table->string('city', 100);
            $table->string('zip_code', 10);
            $table->string('occupation', 100);
            $table->decimal('monthly_income', 15, 2);
            $table->decimal('initial_deposit', 15, 2);
            $table->string('password_hash');
            $table->string('verification_token')->unique();
            $table->timestamp('expires_at');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_registrations');
    }
};
