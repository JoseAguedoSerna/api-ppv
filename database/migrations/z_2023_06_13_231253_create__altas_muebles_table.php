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
        Schema::create('AltasMuebles', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('uuidTipoBien');
            $table->uuid('uuidPersonalResguardo');
            $table->uuid('uuidMarca');
            $table->uuid('uuidModelo');
            $table->uuid('uuidArea');
            $table->uuid('uuidConductor');
            $table->uuid('uuidTipoActivoFijo');
            $table->uuid('uuidTipoAdquisicion');

            //
            $table->integer('NoInventario');
            $table->integer('NoActivo');
            $table->integer('Cantidad');
            $table->string('Descripcion',256);
            $table->float('CostoSinIva');
            $table->float('CostoConIva');
            $table->float('DepreciacionAcumulada');
            $table->dateTime('FechaEntrada');
            $table->dateTime('FechaUltimaActualizacion');
            $table->string('Placas',256);
            $table->string('Series',256);
            $table->year('Anio',256);
            $table->year('VidaUtil',256);
            $table->string('CvePersonal',256);
            $table->string('CveLinea',256);
            $table->string('DescripcionLinea',256);
            $table->integer('CodigoContable');
            $table->dateTime('FechaDeUso');
            $table->integer('ClaveInterior');
            $table->string('DescripcionDetalle',256);
            $table->string('DescripcionTipoActivoFijo',256);

            // ... otras columnas ...
            $table->char('CreadoPor', 36)->nullable();
            $table->char('ModificadoPor', 36)->nullable();
            $table->char('EliminadoPor', 36)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('uuidTipoBien')->references('uuid')->on('TiposBien')->onDelete('cascade');
            $table->foreign('uuidPersonalResguardo')->references('uuid')->on('Empleados')->onDelete('cascade');
            $table->foreign('uuidMarca')->references('uuid')->on('Marcas')->onDelete('cascade');
            $table->foreign('uuidModelo')->references('uuid')->on('Modelos')->onDelete('cascade');
            $table->foreign('uuidArea')->references('uuid')->on('Areas')->onDelete('cascade');
            $table->foreign('uuidConductor')->references('uuid')->on('Empleados')->onDelete('cascade');
            $table->foreign('uuidTipoActivoFijo')->references('uuid')->on('TipoActivoFijo')->onDelete('cascade');
            $table->foreign('uuidTipoAdquisicion')->references('uuid')->on('TiposAdquisicion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('GastoCorriente');
    }
};
