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
        Schema::create('dokumen_akreditasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auditi_id')->nullable()->constrained()->nullOnDelete();
            $table->string('lembaga_akreditasi')->default('BAN-PT');
            $table->string('jenjang')->default('S1');
            $table->string('peringkat')->default('Unggul');
            $table->date('tanggal_sk')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_berakhir')->nullable();
            $table->string('link_sk')->nullable();
            $table->string('link_sertifikat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_akreditasis');
    }
};
