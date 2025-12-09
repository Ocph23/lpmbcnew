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
        Schema::create('audit_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('schedule_code', 50)->unique();
            $table->string('audit_name', 200);
            $table->string('audit_period', 50); // e.g., 'semester_ganjil_2024'
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status', 20)->default('draft'); // 'draft', 'ongoing', 'completed'
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_schedules');
    }
};
