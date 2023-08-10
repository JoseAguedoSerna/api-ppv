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
            $table->dropColumn('DescripcionLinea');
        });


        Schema::table('AltasMuebles', function (Blueprint $table) {
            $table->renameColumn('CveLinea', 'uuidLinea');
        });

        Schema::table('AltasMuebles', function (Blueprint $table) {
            $table->uuid('uuidLinea')->change();
            $table->foreign('uuidLinea')->references('uuid')->on('Lineas')->onDelete('cascade');

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('AltasMuebles', function (Blueprint $table) {
            $table->table('DescripcionLinea');
        });


        Schema::table('AltasMuebles', function (Blueprint $table) {
            $table->renameColumn('uuidLinea', 'CveLinea');
        });

        Schema::table('AltasMuebles', function (Blueprint $table) {
            $table->string('CveLinea')->change();
            $table->dropForeign(['uuidLinea']);

        });
    }
};
