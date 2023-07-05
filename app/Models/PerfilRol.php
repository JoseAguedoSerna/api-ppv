<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Perfiles;
use App\Models\Roles;

class PerfilRol extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'PerfilesRoles';
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $fillable = ['uuidPerfil','uuidRol'];

    public function perfil()
    {
        return $this->belongsTo(Perfiles::class, 'uuidPerfil', 'uuid');
    }

    public function rol()
    {
        return $this->belongsTo(Roles::class, 'uuidRol', 'uuid');
    }

}
