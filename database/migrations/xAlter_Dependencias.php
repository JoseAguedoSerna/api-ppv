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
        Schema::table('Dependencias', function (Blueprint $table) {
            $table->string('uuidTipoDependencia')->after('Telefono');
            $table->string('uuidTitular')->after('uuidTipoDependencia');
            $table->string('uuidSecretaria')->after('uuidTitular');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Dependencias', function (Blueprint $table) {
            //
        });
    }
};
