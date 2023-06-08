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
        if (!Schema::hasTable('Modelos')) {
            Schema::create('Modelos', function (Blueprint $table) {
                $table->uuid('uuid')->primary(); 

                $table->uuid('uuidMarca');
                $table->foreign('uuidMarca')->references('uuid')->on('Marcas')->onDelete('cascade');

                $table->char('Cve',10)->unique();                    
                $table->string('Nombre',256);
                $table->string('Descripcion',256);

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
        Schema::dropIfExists('Modelos');
    }
};
