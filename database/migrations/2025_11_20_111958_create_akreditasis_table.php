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
        Schema::create('akreditasis', function (Blueprint $table) {
        $table->id();
        $table->integer('unggul')->default(0);
        $table->integer('peringkat_a')->default(0);
        $table->integer('baik_sekali')->default(0);
        $table->integer('peringkat_baik')->default(0);
        $table->integer('peringkat_b')->default(0);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akreditasis');
    }
};
