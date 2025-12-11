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
        Schema::create('jadwal_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auditi_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('periode_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('auditor_id')->constrained()->onDelete('cascade');
            $table->foreignId('auditor2_id')->nullable()->constrained('auditors')->nullOnDelete();
            $table->date('start_date');
            $table->string('status')->default('terjadwal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_audits');
    }
};
