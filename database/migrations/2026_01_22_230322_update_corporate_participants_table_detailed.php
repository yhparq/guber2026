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
        Schema::table('corporate_participants', function (Blueprint $table) {
            $table->string('ruc')->nullable()->after('id');
            $table->string('address')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('corporate_participants', function (Blueprint $table) {
            $table->dropColumn(['ruc', 'address', 'contact_name', 'contact_phone']);
        });
    }
};
