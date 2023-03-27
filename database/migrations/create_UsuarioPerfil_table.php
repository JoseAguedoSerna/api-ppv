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
        Schema::create('UsuarioPerfil', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreign('uuidUsuario')->references('uuid')->on('Usuarios')->onDelete('cascade');
            $table->foreign('uuidPerfil')->references('uuid')->on('Perfiles')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UsuarioPerfil');
    }
};
