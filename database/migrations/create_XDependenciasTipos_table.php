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
        Schema::create('DependenciasTipos', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->uuid('uuidDependencias');
            $table->foreign('uuidDependencias')->references('uuid')->on('Dependencias')->onDelete('cascade');
            
            $table->uuid('uuidTipoDependencias');
            $table->foreign('uuidTipoDependencias')->references('uuid')->on('TipoDependencias')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DependenciasTipos');
    }
};
