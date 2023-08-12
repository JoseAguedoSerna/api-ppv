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
        if (!Schema::hasTable('AsignacionResguardos')) {
        Schema::create('AsignacionResguardos', function (Blueprint $table) {
                $table->uuid('uuid')->primary();
                $table->uuid('uuidEmpleado');
                $table->uuid('uuidDependencia');
                $table->uuid('uuidDepartamento');
                $table->uuid('uuidDependenciaPertenece');
                $table->uuid('uuidAltaBienMueble');
                $table->string('Ubicacion',256);
                // ... otras columnas ...
                $table->char('CreadoPor', 36)->nullable();
                $table->char('ModificadoPor', 36)->nullable();
                $table->char('EliminadoPor', 36)->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('uuidEmpleado')->references('uuid')->on('Empleados')->onDelete('cascade');
                $table->foreign('uuidDependencia')->references('uuid')->on('Dependencias')->onDelete('cascade');
                $table->foreign('uuidDependenciaPertenece')->references('uuid')->on('Dependencias')->onDelete('cascade');
                $table->foreign('uuidAltaBienMueble')->references('uuid')->on('AltasMuebles')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('AsignacionResguardos');
    }
};
