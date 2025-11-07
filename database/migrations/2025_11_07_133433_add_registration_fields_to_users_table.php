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
            // Only add columns that don't exist yet
            if (!Schema::hasColumn('users', 'employment_status')) {
                $table->enum('employment_status', ['employed', 'self-employed', 'student', 'unemployed', 'retired'])->nullable()->after('occupation');
            }
            if (!Schema::hasColumn('users', 'employer_name')) {
                $table->string('employer_name')->nullable()->after('monthly_income');
            }
            if (!Schema::hasColumn('users', 'marketing_consent')) {
                $table->boolean('marketing_consent')->default(false)->after('initial_deposit');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'employment_status',
                'employer_name',
                'marketing_consent'
            ]);
        });
    }
};
