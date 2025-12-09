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
        Schema::table('jadwal_audits', function (Blueprint $table) {
            $table->foreignId('auditor2_id')->nullable()->constrained('users')->nullOnDelete()->after('auditor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_audits', function (Blueprint $table) {
            $table->dropForeign(['auditor2_id']);
            $table->dropColumn('auditor2_id');
        });
    }
};
