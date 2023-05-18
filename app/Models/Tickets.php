<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Tickets extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = "Tickets"; #Se indica el nombre de la tabla
    protected $primaryKey = "uuid"; #Definimos campo uuis como primary key"
    public $incrementing = false;  #Quitamos que sea autoincremental
    protected $fillable = ['Cve','Descripcion','Asignadoa','uuidTipoTicket','uuidCategoriaTicket','uuidPrioridadTickets','uuidStatusTicket',
                            'CreadoPor','ModificadoPor','EliminadoPor',
                            'created_at','updated_at','deleted_at']; #Se agregan los campos de la tabla que serán visibles en las consultas

    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'Asignadoa');
    }

    public function tipoTicket()
    {
        return $this->belongsTo(TiposTickets::class, 'uuidTipoTicket');
    }

    public function categoriaTicket()
    {
        return $this->belongsTo(CategoriasTickets::class, 'uuidCategoriaTicket');
    }

    public function prioridadTicket()
    {
        return $this->belongsTo(PrioridadTickets::class, 'uuidPrioridadTickets');
    }

    public function statusTicket()
    {
        return $this->belongsTo(StatusTickets::class, 'uuidStatusTicket');
    }
}
