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
        if (!Schema::hasTable('ValoresSistema')) {
            Schema::create('ValoresSistema', function (Blueprint $table) {
                $table->uuid('uuid')->primary(); 

                $table->char('Cve',15);
                $table->string('Descripcion',200);
                $table->integer('Tipo');
                $table->string('ParamStr')->nullable();
                $table->integer('ParamInt')->nullable();

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
        Schema::dropIfExists('ValoresGlobales');
    }
};
