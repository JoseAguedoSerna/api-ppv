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
        Schema::create('RolMenu', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('uuidRol');
            $table->foreign('uuidRol')->references('uuid')->on('Roles')->onDelete('cascade');
            $table->uuid('uuidMenu');
            $table->foreign('uuidMenu')->references('uuid')->on('Menus')->onDelete('cascade');            
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RolMenu');
    }
};
