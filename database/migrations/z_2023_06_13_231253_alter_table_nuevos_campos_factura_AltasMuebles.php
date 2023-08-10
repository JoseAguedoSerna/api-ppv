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
            $table->string('NumFactura')->nullable()->after('DescripcionDetalle');
            $table->uuid('uuidProveedor')->after('uuidTipoAdquisicion');
            $table->string('Folio')->nullable()->after('uuidTipoAdquisicion');

            $table->foreign('uuidProveedor')->references('uuid')->on('Proveedores')->onDelete('cascade');

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('AltasMuebles', function (Blueprint $table) {
            $table->dropForeign(['uuidConductor']);
            $table->dropColumn('uuidProveedor');
            $table->dropColumn('NumFactura');
            $table->dropColumn('Folio');
        });
    }
};
