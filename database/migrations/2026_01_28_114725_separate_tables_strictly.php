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
        // 1. Clean up participants table (Remove group stuff)
        Schema::table('participants', function (Blueprint $table) {
            if (Schema::hasColumn('participants', 'razon_social_grupo')) {
                $table->dropColumn('razon_social_grupo');
            }
            // Ensure RUC exists for individuals (added in previous step, but safe to check)
            if (!Schema::hasColumn('participants', 'ruc')) {
                $table->string('ruc')->nullable();
            }
        });

        // 2. Recreate corporate_participants table to be a full person register + company info
        Schema::dropIfExists('corporate_participants');

        Schema::create('corporate_participants', function (Blueprint $table) {
            $table->id();
            
            // --- Group / Payment Info (Repeated for each member for simplicity) ---
            $table->string('razon_social');
            $table->string('codigo_pago');
            $table->string('foto_voucher')->nullable();
            $table->string('tipo_comprobante_pago')->nullable(); // Factura/Boleta of the payment
            
            // --- Personal Info (Same as participants table) ---
            $table->string('dni');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email');
            $table->string('celular');
            
            // Location
            $table->string('departamento')->nullable();
            $table->string('provincia')->nullable();
            $table->string('distrito')->nullable();
            $table->string('direccion')->nullable();
            
            // Professional / Event Info
            $table->string('colegio_departamental')->nullable();
            $table->string('categoria_participante');
            $table->string('modalidad_participante');
            
            // Individual Invoice Info (If they want their own invoice despite group payment)
            $table->string('tipo_comprobante_individual')->nullable();
            $table->string('ruc_individual')->nullable(); // If individual invoice is Factura

            $table->integer('status')->default(0)->comment('0: Pending, 1: Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corporate_participants');
        
        // Restore old structure (simplified for down)
        Schema::create('corporate_participants', function (Blueprint $table) {
            $table->id();
            $table->string('company_name'); // Old name
            $table->timestamps();
        });
    }
};