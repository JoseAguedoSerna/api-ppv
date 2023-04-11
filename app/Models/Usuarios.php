<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Models\UsuarioPerfil;

class Usuarios extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = "Usuarios"; #Se indica el nombre de la tabla
    protected $primaryKey = "uuid"; #Definimos campo uuis como primary key"
    public $incrementing = false;  #Quitamos que sea autoincremental
    protected $fillable = ['uuidTiCentral','uuidDependencia','NombreCorto','Puesto',
                            'CreadoPor','ModificadoPor','EliminadoPor',
                            'created_at','updated_at','deleted_at']; #Se agregan los campos de la tabla que serán visibles en las consultas

    public function perfiles()
    {
        return $this->hasMany(UsuarioPerfil::class,'uuidUsuario','uuid');
    }

}
