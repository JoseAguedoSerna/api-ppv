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
        Schema::table('AltasMuebles', function (Blueprint $table) {
            $table->dropForeign(['uuidMarca']);
            $table->dropForeign(['uuidModelo']);
        });

        Schema::table('AltasMuebles', function (Blueprint $table) {
            $table->dropColumn('Descripcion');
            $table->dropColumn('NoInventario');
            $table->dropColumn('uuidMarca');
            $table->dropColumn('uuidModelo');
            $table->dropColumn('Series');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('AltasMuebles', function (Blueprint $table) {
            $table->table('Descripcion');
            $table->table('NoInventario');
            $table->table('uuidMarca');
            $table->table('uuidModelo');
            $table->table('Series');
        });

    }
};
