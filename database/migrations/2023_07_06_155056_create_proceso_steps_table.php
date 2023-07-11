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
        if (!Schema::hasTable('ProcesoSteps')) {
            Schema::create('ProcesoSteps', function (Blueprint $table) {
                $table->uuid('uuid')->primary(); 
                $table->uuid('uuidProceso');
                $table->foreign('uuidProceso')->references('uuid')->on('Procesos')->onDelete('cascade');
                $table->char('Cve',15);
                $table->char('Nombre',50);
                $table->char('Descripcion',100);
                $table->integer('Ordenamiento');
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
        Schema::dropIfExists('ProcesoSteps');
    }
};
