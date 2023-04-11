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
        if (!Schema::hasTable('Menus')) {
            Schema::create('Menus', function (Blueprint $table) {
                $table->uuid('uuid')->primary(); 

                $table->char('Cve',10)->unique();                    
                $table->string('Nombre',256);
                $table->string('Descripcion',256);
                $table->string('Icono',50);
                $table->string('Path',256);
                $table->tinyInteger('Nivel')->default(0);
                $table->tinyInteger('Ordenamiento')->default(0);

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
        Schema::dropIfExists('Menus');
    }
};
