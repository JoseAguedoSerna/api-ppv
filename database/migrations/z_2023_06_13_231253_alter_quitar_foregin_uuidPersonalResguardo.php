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
            $table->dropForeign(['uuidPersonalResguardo']);
            $table->dropColumn('uuidPersonalResguardo');
            $table->dropColumn('CvePersonal');
            $table->dropColumn('DescripcionDetalle');

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('AltasMuebles', function (Blueprint $table) {

        });
    }
};
