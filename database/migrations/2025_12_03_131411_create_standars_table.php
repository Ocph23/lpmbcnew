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
        Schema::create('standars', function (Blueprint $table) {
            $table->id(); // SERIAL PRIMARY KEY
            $table->string('standar_code', 20);
            $table->string('standar_name', 200);
            $table->text('description')->nullable();
            $table->string('category', 100); // e.g., 'akademik', 'non-akademik'
            $table->float('weight')->default(1.0);
            $table->timestamps(); // Optional: adds created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standars');
    }
};
