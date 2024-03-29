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
        if (!Schema::hasTable('Resguardos')) {
            Schema::create('Resguardos', function (Blueprint $table) {
                $table->uuid('uuid')->primary(); 

                $table->integer('IdResguardo')->unique();

                $table->uuid('uuidEmpleado');
                $table->foreign('uuidEmpleado')->references('uuid')->on('Empleados')->onDelete('cascade');

                $table->uuid('uuidEstatusResguardo');
                $table->foreign('uuidEstatusResguardo')->references('uuid')->on('EstatusResguardo')->onDelete('cascade');

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
        Schema::dropIfExists('Resguardos');
    }
};
