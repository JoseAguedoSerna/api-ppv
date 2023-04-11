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
        Schema::create('ResguardoDet', function (Blueprint $table) {
            $table->uuid('uuid')->primary(); 

            $table->uuid('uuidResguardo');
            $table->foreign('uuidResguardo')->references('uuid')->on('Resguardos')->onDelete('cascade');
            $table->uuid('uuidArticulo');
            $table->foreign('uuidArticulo')->references('uuid')->on('Articulos')->onDelete('cascade');
            
            $table->tinyint('Estatus');

            $table->char('CreadoPor', 36)->nullable();
            $table->char('ModificadoPor', 36)->nullable();
            $table->char('EliminadoPor', 36)->nullable();
            $table->timestamps();
            $table->softDeletes();            
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ResguardoDet');
    }
};
