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
        Schema::table('TiposAdquisicion', function (Blueprint $table) {
            $table->uuid('Proceso')->nullable()->after('CreadoPor');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('TiposAdquisicion', function (Blueprint $table) {
            $table->dropColumn('Proceso');
        });
    }
};


// 2023_08_02_093245_alter_TipoAdquisicion_table