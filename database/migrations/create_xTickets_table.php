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
        if (!Schema::hasTable('Tickets')) {
            Schema::create('Tickets', function (Blueprint $table) {
                $table->uuid('uuid')->primary(); 

                $table->char('Cve',10)->unique();                    
                $table->string('Descripcion',5000);
                $table->string('Asignado a',150);

                $table->uuid('uuidTipoTicket');
                $table->foreign('uuidTipoTicket')->references('uuid')->on('TiposTickets')->onDelete('cascade');      
                $table->char('uuidCategoriaTicket', 36)->nullable();
                $table->foreign('uuidCategoriaTicket')->references('uuid')->on('CategoriasTickets')->onDelete('cascade');
                $table->uuid('uuidPrioridadTickets');
                $table->foreign('uuidPrioridadTickets')->references('uuid')->on('PrioridadTickets')->onDelete('cascade');
                $table->char('uuidStatusTicket', 36)->nullable();
                $table->foreign('uuidStatusTicket')->references('uuid')->on('StatusTickets')->onDelete('cascade');

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
        Schema::dropIfExists('Tickets');
    }
};
