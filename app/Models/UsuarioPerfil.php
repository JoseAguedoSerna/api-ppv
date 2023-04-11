<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Usuarios;
use App\Models\Perfiles;

class UsuarioPerfil extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'UsuariosPerfiles';
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $fillable = ['uuidUsuario','uuidPerfil'];

    public function usuario()
    {
        return $this->belongsTo(Usuarios::class,'uuidUsuario','uuid');
    }

    public function perfil()
    {
        return $this->belongsTo(Perfiles::class,'uuidPerfil','uuid');
    }
}
