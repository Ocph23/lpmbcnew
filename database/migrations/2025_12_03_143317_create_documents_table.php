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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('document_code', 50)->unique();
            $table->string('title', 300);
            $table->text('description')->nullable();
            $table->string('file_path', 500);
            $table->unsignedBigInteger('file_size');
            $table->string('mime_type', 100);
            $table->string('document_type', 50); // 'kebijakan', 'sop', 'formulir', 'bukti'
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->onDelete('set null');
            $table->date('validity_date')->nullable(); // Tanggal kadaluarsa
            $table->string('status', 20)->default('draft'); // 'draft', 'approved', 'expired'
            $table->foreignId('standar_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('version')->default(1);
            $table->foreignId('previous_version_id')->nullable()->constrained('documents')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
