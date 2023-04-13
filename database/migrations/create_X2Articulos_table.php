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
        if (!Schema::hasTable('Articulos')) {
            Schema::create('Articulos', function (Blueprint $table) {
                $table->uuid('uuid')->primary(); 

                $table->char('QR',45)->unique();                    
                $table->char('CI',45)->unique();
                $table->string('Descripcion',256);
                $table->string('NoSerie',45);

                $table->uuid('uuidMarca');
                $table->foreign('uuidMarca')->references('uuid')->on('Marcas')->onDelete('cascade');

                $table->uuid('uuidModelos');
                $table->foreign('uuidModelos')->references('uuid')->on('Modelos')->onDelete('cascade');
                
                $table->uuid('uuidClasificacion');
                $table->foreign('uuidClasificacion')->references('uuid')->on('TiposClasificacion')->onDelete('cascade');
                
                $table->boolean('Activo');

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
        Schema::dropIfExists('Articulos');
    }
};
