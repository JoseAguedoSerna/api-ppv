<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('AltasMuebles', function (Blueprint $table) {
            // Eliminar la referencia de la columna 'uuidConductor'
            $table->dropForeign(['uuidConductor']);

            // Eliminar el campo 'uuidConductor' de la tabla
            $table->dropColumn('uuidConductor');
        });
    }
//hola

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
