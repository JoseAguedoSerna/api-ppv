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
        Schema::create('Menus', function (Blueprint $table) {
            $table->uuid('uuid')->primary();                        
            $table->string('Nombre',256);
            $table->string('Descripcion',256);
            $table->string('Icono',50);
            $table->string('Path',256);
            $table->tinyInteger('Nivel')->default(0);
            $table->string('Ordenamiento')->default(0);

            $table->char('CreadoPor', 36)->nullable();
            $table->timestamps('FechaCreacion')->useCurrent();
            $table->char('ModificacoPor', 36)->nullable();
            $table->timestamp('FechaModificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('Menus');
    }
};
