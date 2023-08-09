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
        Schema::create('LineasDetallesAlta', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('uuidAltaMueble');
            $table->integer('NoInventario');
            $table->uuid('uuidMarca');
            $table->uuid('uuidModelo');
            $table->string('Serie', 256);
            $table->string('ValorFactura', 256);
            $table->string('Descripcion', 256);
            $table->string('Condicion', 256);
            $table->char('CreadoPor', 36)->nullable();
            $table->char('ModificadoPor', 36)->nullable();
            $table->char('EliminadoPor', 36)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('LineasDetallesAlta', function (Blueprint $table) {
            $table->foreign('uuidAltaMueble')->references('uuid')->on('AltasMuebles')->onDelete('cascade');
            $table->foreign('uuidMarca')->references('uuid')->on('Marcas')->onDelete('cascade');
            $table->foreign('uuidModelo')->references('uuid')->on('Modelos')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('LineasDetallesAlta');
    }
};
