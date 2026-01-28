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
        // We will focus on enhancing the participants table to hold everything flatly
        Schema::table('participants', function (Blueprint $table) {
            // Group details stored directly in the participant row
            $table->string('razon_social_grupo')->nullable()->after('celular'); 
            $table->string('ruc')->nullable()->after('dni'); // Individual RUC
            $table->integer('status')->default(0)->comment('0: Pending, 1: Active');
            
            // Ensure payment fields exist if they weren't there (they were added in previous update migrations, but good to be safe or explicit)
            // The previous migration '2026_01_22_230226_update_participants...' already added codigo_pago, tipo_comprobante, foto_voucher.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn(['razon_social_grupo', 'ruc', 'status']);
        });
    }
};
