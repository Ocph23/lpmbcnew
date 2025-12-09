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
        Schema::create('audit_instruments', function (Blueprint $table) {
            $table->id();
            $table->string('instrument_code', 50);
            $table->text('question_text');
            $table->foreignId('standar_id')->nullable()->constrained()->onDelete('set null');
            $table->float('weight')->default(1.0);
            $table->string('evidence_type', 50); // 'dokumen', 'observasi', 'wawancara'
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_instruments');
    }
};
