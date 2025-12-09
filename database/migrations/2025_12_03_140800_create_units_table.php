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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('unit_code', 20)->unique();
            $table->string('unit_name', 200);
            $table->string('unit_type', 50); // 'fakultas', 'prodi', 'bureau', 'lab'
            $table->foreignId('parent_unit_id')->nullable()->constrained('units')->onDelete('set null');
            $table->foreignId('head_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
