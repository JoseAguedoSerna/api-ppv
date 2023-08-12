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
        if (!Schema::hasTable('Citas')) {
            Schema::create('Citas', function (Blueprint $table) {
                $table->uuid('uuid')->primary();                
                $table->string('Asunto',100);
                $table->string('NoResguardo',100);
                $table->string('NomResguardante',100);
                $table->string('Descripcion',500);
                $table->string('Departamento',50);
                $table->string('FechaProgramada',10);
                $table->string('HoraProgramada',5);
                $table->tinyInteger('Status')->default(0);
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
        Schema::dropIfExists('Citas');
    }
};
