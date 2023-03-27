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
        Schema::create('PerfilRol', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('uuidPerfil');
            $table->foreign('uuidPerfil')->references('uuid')->on('Perfiles')->onDelete('cascade');
            $table->uuid('uuidRol');
            $table->foreign('uuidRol')->references('uuid')->on('Roles')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PerfilRol');
    }
};
