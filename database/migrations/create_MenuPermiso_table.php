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
        Schema::create('MenuPermiso', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreign('uuidMenu')->references('uuid')->on('Menus')->onDelete('cascade');
            $table->foreign('uuidPermiso')->references('uuid')->on('Permisos')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MenuPermiso');
    }
};
