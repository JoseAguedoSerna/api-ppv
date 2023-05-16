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
    protected $fillable = ['Cve','Descripcion','Asignado a','uuidTipoTicket','uuidCategoriaTicket','uuidPrioridadTickets','uuidStatusTicket',
                            'CreadoPor','ModificadoPor','EliminadoPor',
                            'created_at','updated_at','deleted_at']; #Se agregan los campos de la tabla que serán visibles en las consultas


    // relacion con empleados
    public function asignadoa()
    {
        return $this->belongsTo('App\Models\Empleados');
    }
    // relacion con tipo ticket
    public function tipostickets()
    {
        return $this->belongsTo ('App\Models\TiposTickets');
    }         
    // relacion con categoria ticket
    public function categoriastickets()
    {
        return $this->belongsTo ('App\Models\CategoriasTickets');
    }          
    // relacion con prioridad ticket
    public function prioridadtickets()
    {
        return $this->belongsTo ('App\Models\PrioridadTickets');
    }             
    // relacion con status ticket
    public function statusticket()
    {
        return $this->belongsTo ('App\Models\StatusTickets');
    }  
}
