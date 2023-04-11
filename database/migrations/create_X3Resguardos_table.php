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
        if (!Schema::hasTable('Resguardos')) {
            Schema::create('Resguardos', function (Blueprint $table) {
                $table->uuid('uuid')->primary(); 

                $table->uuid('uuidTipoComprobante');
                $table->foreign('uuidTipoComprobante')->references('uuid')->on('TiposComprobantes')->onDelete('cascade');

                $table->char('NoComprobante',10)->unique();                    

                $table->uuid('uuidProveedor');
                $table->foreign('uuidProveedor')->references('uuid')->on('Proveedores')->onDelete('cascade');

                $table->date('FechaFactura'); 
                $table->date('FechaRecepcion');

                $table->string('Descripcion',256);

                $table->uuid('uuidTiposAdquisicion');
                $table->foreign('uuidTiposAdquisicion')->references('uuid')->on('TiposAdquisicion')->onDelete('cascade');

                $table->string('AñoCompra',4);

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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Resguardos');
    }
};
