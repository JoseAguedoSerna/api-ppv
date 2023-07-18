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
            $table->string('RutaFactura')->nullable()->after('DescripcionDetalle');
            $table->string('ConfirmacionCoordinacionBM')->nullable()->after('RutaFactura');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('AltasMuebles', function (Blueprint $table) {
            $table->dropColumn('RutaFactura');
            $table->dropColumn('ConfirmacionCoordinacionBM');
        });
    }
};
