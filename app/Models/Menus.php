<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Models\Menus;

class Menus extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = "Menus"; #Se indica el nombre de la tabla
    protected $primaryKey = "uuid"; #Definimos campo uuis como primary key"
    public $incrementing = false;  #Quitamos que sea autoincremental
    protected $fillable = ['Cve','Nombre','Descripcion','Icono','Path','Nivel','Ordenamiento','MenuPadre',
                            'CreadoPor','ModificadoPor','EliminadoPor',
                            'created_at','updated_at','deleted_at']; 
    protected $appends = ['Padre'];

    public function roles()
    {
        return $this->hasMany('App\Models\RolMenu', 'uuidMenu', 'uuid');
    }

    public function getPadreAttribute()
    {
        return Menus::select('uuid','Nombre','MenuPadre')->find($this->MenuPadre);
    }


}
