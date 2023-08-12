<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('Rangos')) {
            Schema::create('Rangos', function (Blueprint $table) {
                $table->uuid('uuid')->primary(); 

                $table->char('Tipo',15);
                $table->integer('Verde');
                $table->integer('Amarillo');
                $table->integer('Rojo');
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
     */
    public function down(): void
    {
        Schema::dropIfExists('Rangos');
    }
};
