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
        Schema::create('Municipios', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->char('Cve',6)->nullable();
            $table->string('Nombre',256);
            $table->string('NombreCorto',10);
            
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
        Schema::dropIfExists('Municipios');
    }
};
