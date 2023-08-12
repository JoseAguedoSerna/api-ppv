<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Models\AltasMuebles;



class AsignacionResguardo extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = "AsignacionResguardos"; #Se indica el nombre de la tabla    
    protected $primaryKey = "uuid"; #Definimos campo uuis como primary key"   
    protected $foreignKey = 'uuidAltaBienMueble'; 
    public $incrementing = false;  #Quitamos que sea autoincremental
    protected $fillable = [
        'uuidEmpleado',
        'uuidDependencia',
        'uuidDepartamento',
        'uuidDependenciaPertenece',
        'uuidAltaBienMueble',
        'Ubicacion',
        'NumeroResguardo'
    ];
    
    public function altasMuebles()
    {
        return $this->belongsTo(AltasMuebles::class, 'uuidAltaBienMueble');
    }

}
