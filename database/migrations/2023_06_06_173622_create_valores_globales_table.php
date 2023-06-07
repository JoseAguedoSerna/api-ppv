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
        if (!Schema::hasTable('ValoresGlobales')) {
            Schema::create('ValoresGlobales', function (Blueprint $table) {
                $table->uuid('uuid')->primary(); 

                $table->char('Modulo',20);
                $table->char('Cve',10);
                $table->string('Descripcion',100);
                $table->integer('Tipo');
                $table->string('ParamStr')->nullable();
                $table->integer('ParamInt')->nullable();
                $table->float('ParamFloat')->nullable();

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
