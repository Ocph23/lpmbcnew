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
        Schema::create('audit_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_schedule_id')->constrained()->onDelete('cascade');
            $table->foreignId('auditor_id')->constrained('users')->onDelete('cascade');
            $table->string('role_in_team', 50); // 'ketua', 'anggota'
            $table->json('assigned_units')->nullable(); // Laravel uses JSON; PostgreSQL will treat as JSONB
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_teams');
    }
};
