<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documentos extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = "Documentos"; #Se indica el nombre de la tabla
    protected $primaryKey = "documentable_id"; #Definimos campo uuis como primary key"
    public $incrementing = false;  #Quitamos que sea autoincremental

    protected $fillable = ['Documentable_type','created_at','updated_at','deleted_at','Nombre','RutaFolder'];

    public function documentable()
    {
        return $this->morphTo();
    }
}
