<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Support\Facades\DB;


class Menus extends Model
{
    use HasFactory, HasUuids;
    protected $table = "Menus";
    // Cambiamos la clave primaria al campo "nuevo_producto_id"
    protected $primaryKey = "uuid";
    // Quitamos que sea autoincremental
    public $incrementing = false; 

    protected $fillable = ['Cve','Nombre','Descripcion','Icono','Path','Nivel','Ordenamiento',
                            'CreadoPor','ModificadoPor','EliminadoPor',
                            'created_at','updated_at','deleted_at'];
   
}
