<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Articulos extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = "Articulos"; #Se indica el nombre de la tabla    
    protected $primaryKey = "uuid"; #Definimos campo uuis como primary key"    
    public $incrementing = false;  #Quitamos que sea autoincremental
    protected $fillable = ['uuidTipoComprobante','NoComprobante','uuidProveedor','uuidTiposAdquisicion',
                            'FechaFactura','FechaRecepcion','uuidClasificacion','QR','CodigoInterno',
                            'Descripcion','NoSerie','uuidMarca','uuidModelos','Activo',
                            'CreadoPor','ModificadoPor','EliminadoPor',
                            'created_at','updated_at','deleted_at']; #Se agregan los campos de la tabla que serán visibles en las consultas
   
}