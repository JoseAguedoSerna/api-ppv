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
        if (!Schema::hasTable('UsuariosPerfiles')) {
            Schema::create('UsuariosPerfiles', function (Blueprint $table) {
                $table->uuid('uuid')->primary();
                $table->uuid('uuidUsuario');
                $table->foreign('uuidUsuario')->references('uuid')->on('Usuarios')->onDelete('cascade');
                $table->uuid('uuidPerfil');
                $table->foreign('uuidPerfil')->references('uuid')->on('Perfiles')->onDelete('cascade');
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
        Schema::dropIfExists('UsuariosPerfiles');
    }
};
