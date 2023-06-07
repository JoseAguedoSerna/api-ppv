<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Lineas extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = "Lineas"; #Se indica el nombre de la tabla    
    protected $primaryKey = "uuid"; #Definimos campo uuis como primary key"    
    public $incrementing = false;  #Quitamos que sea autoincremental
    protected $fillable = ['Cve','Nombre','Descripcion',
                            'CreadoPor','ModificadoPor','EliminadoPor',
                            'created_at','updated_at','deleted_at']; #Se agregan los campos de la tabla que serán visibles en las consultas
   
}