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
        Schema::create('Usuarios', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('uuidTiCentral');

            $table->uuid('uuidDependencia');
            $table->foreign('uuidDependencia')->references('uuid')->on('Dependencias')->onDelete('cascade');
            $table->string('NombreCorto',10)->unique();
            $table->char('Puesto', 36)->nullable();

            $table->char('CreadoPor', 36)->nullable();
            $table->char('ModificacoPor', 36)->nullable();
            $table->char('EliminadoPor', 36)->nullable();
            $table->timestamps();
            $table->softDeletes();     
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Usuarios');
    }
};
