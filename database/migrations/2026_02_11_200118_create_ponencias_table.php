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
        Schema::create('ponencias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('ponente');
            $table->text('descripcion')->nullable();
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->integer('dia'); // 1, 2, or 3
            $table->string('link_video')->nullable();
            $table->string('link_material')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ponencias');
    }
};
