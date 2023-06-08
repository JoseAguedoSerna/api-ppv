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
        if (!Schema::hasTable('Dependencias')) {
            Schema::create('Dependencias', function (Blueprint $table) {
                $table->uuid('uuid')->primary();

                $table->char('Cve',10)->unique();
                $table->string('Nombre',256);
                $table->string('Direccion',256);
                $table->string('Telefono',10);

                $table->uuid('uuidTipoDependencia');
                $table->foreign('uuidTipoDependencia')->references('uuid')->on('TipoDependencia')->onDelete('cascade');

                $table->uuid('uuidTitular');
                $table->foreign('uuidTitular')->references('uuid')->on('Titular')->onDelete('cascade');

                $table->uuid('uuidSecretaria');
                $table->foreign('uuidSecretaria')->references('uuid')->on('Secretaria')->onDelete('cascade');
                
                $table->char('CreadoPor', 36)->nullable();
                $table->char('ModificadoPor', 36)->nullable();
                $table->char('EliminadoPor', 36)->nullable();
                $table->timestamps();
                $table->softDeletes();     
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
        Schema::dropIfExists('Dependencias');
    }
};
