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
            // Drop the foreign key relationship if it exists
            if (Schema::hasColumn('participants', 'corporate_participant_id')) {
                // We need to know the foreign key name. Usually table_column_foreign.
                // Assuming standard naming convention or try catch.
                // Simplest is to drop the column, some DBs auto drop FK.
                // SQLite does not support dropping columns with FK easily, but MySQL does.
                // Laravel constrained() uses standard naming.
                $table->dropForeign(['corporate_participant_id']);
                $table->dropColumn('corporate_participant_id');
            }

            if (!Schema::hasColumn('participants', 'razon_social_grupo')) {
                $table->string('razon_social_grupo')->nullable()->after('celular');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn('razon_social_grupo');
            $table->foreignId('corporate_participant_id')->nullable()->constrained('corporate_participants')->onDelete('cascade');
        });
    }
};