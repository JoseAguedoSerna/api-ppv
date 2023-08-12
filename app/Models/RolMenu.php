<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Models\Menus;

class RolMenu extends Model
{
    use HasFactory, HasUuids;
    protected $table = "RolesMenus"; #Se indica el nombre de la tabla    
    protected $primaryKey = "uuid"; #Definimos campo uuis como primary key"    
    public $incrementing = false;  #Quitamos que sea autoincremental
    public $timestamps = false; #deshabilitar campos de create_by, modify_by etc
    protected $fillable = ['uuidRol','uuidMenu']; #Se agregan los campos de la tabla que serán visibles en las consultas
    protected $appends = ['MenuInfo'];

    public function getMenuInfoAttribute()
    {
        return Menus::select('uuid','Nombre','MenuPadre')->find($this->uuidMenu);
    }
   
}
