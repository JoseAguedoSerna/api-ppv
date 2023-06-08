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
        if (!Schema::hasTable('Mensajes')) {
            Schema::create('Mensajes', function (Blueprint $table) {
                $table->uuid('uuid')->primary();   
                $table->uuid('Asignadoa');                         
                $table->string('Encabezado',50);
                $table->string('Descripcion',2000);
                $table->tinyInteger('Visto')->default(0);

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
        Schema::dropIfExists('Mensajes');
    }
};
