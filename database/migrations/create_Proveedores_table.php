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
        Schema::create('Proveedores', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            
            $table->char('Cve',6)->nullable();
            $table->string('Nombre',256);
            $table->string('Descripcion',256);

            $table->char('CreadoPor', 36)->nullable();
            $table->timestamps('FechaCreacion')->nullable();
            $table->char('ModificacoPor', 36)->nullable();
            $table->timestamps('FechaModificacion')->nullable();
            $table->char('EliminadoPor', 36)->nullable();
            $table->timestamps('FechaEliminacion')->nullable();
            $table->tinyInteger('Deleted')->default(0);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Proveedores');
    }
};
