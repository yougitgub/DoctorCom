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
    Schema::table('appointments', function (Blueprint $table) {
        $table->foreignId('session_id')->nullable()->constrained('appointment_sessions')->cascadeOnDelete();
        $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
        // $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        // $table->dropColumn('doctor_id'); // Remove old direct doctor reference
        // $table->dropColumn('appointment_date'); // Use session's date_time instead
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
