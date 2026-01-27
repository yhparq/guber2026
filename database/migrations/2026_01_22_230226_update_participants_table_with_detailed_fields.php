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
        Schema::table('participants', function (Blueprint $table) {
            $table->string('dni')->nullable()->after('id');
            $table->string('nombres')->nullable()->after('dni');
            $table->string('apellidos')->nullable()->after('nombres');
            // email is already there
            $table->string('celular')->nullable()->after('email');
            $table->string('colegio_departamental')->nullable();
            $table->string('departamento')->nullable();
            $table->string('provincia')->nullable();
            $table->string('distrito')->nullable();
            $table->string('direccion_actual')->nullable();
            $table->string('categoria_participante')->nullable();
            $table->string('modalidad_participante')->nullable();
            $table->string('codigo_pago')->nullable();
            $table->string('tipo_comprobante')->nullable();
            $table->string('foto_voucher')->nullable();
            
            // Remove name if it exists since we now have nombres/apellidos
            if (Schema::hasColumn('participants', 'name')) {
                $table->dropColumn('name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn([
                'dni', 'nombres', 'apellidos', 'celular', 'colegio_departamental',
                'departamento', 'provincia', 'distrito', 'direccion_actual',
                'categoria_participante', 'modalidad_participante', 'codigo_pago',
                'tipo_comprobante', 'foto_voucher'
            ]);
            $table->string('name')->nullable();
        });
    }
};
