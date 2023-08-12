<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class MenuPermiso extends Model
{
    use HasFactory, HasUuids;
    protected $table = "MenusPermiso"; #Se indica el nombre de la tabla    
    protected $primaryKey = "uuid"; #Definimos campo uuis como primary key"    
    public $incrementing = false;  #Quitamos que sea autoincremental
    public $timestamps = false; #deshabilitar campos de create_by, modify_by etc
    protected $fillable = ['uuidMenu','uuidPermiso']; #Se agregan los campos de la tabla que serán visibles en las consultas
   
}