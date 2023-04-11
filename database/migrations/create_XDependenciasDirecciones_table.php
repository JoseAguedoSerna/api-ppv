<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('DependenciasDirecciones')) {
            Schema::create('DependenciasDirecciones', function (Blueprint $table) {
                $table->uuid('uuid')->primary();

                $table->uuid('uuidDependencias');
                $table->foreign('uuidDependencias')->references('uuid')->on('Dependencias')->onDelete('cascade');
                
                $table->uuid('uuidDireccionesDependencias');
                $table->foreign('uuidDireccionesDependencias')->references('uuid')->on('DireccionesDependencias')->onDelete('cascade');
            });
        }
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DependenciasDirecciones');
    }
};
