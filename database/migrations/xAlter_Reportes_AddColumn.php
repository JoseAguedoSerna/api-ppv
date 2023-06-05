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
        Schema::table('Reportes', function (Blueprint $table) {
            $table->uuid('uuidTipoReporte')->after('Descripcion');            
            // $table->foreign('uuidTipoReporte')->references('uuid')->on('TiposReportes')->onDelete('cascade');            
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Reportes', function (Blueprint $table) {
            //
        });
    }
};
