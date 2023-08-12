<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TiposAdquisicion;

class AltasMuebles extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'AltasMuebles';
    protected $primaryKey = 'uuid';
    protected $foreignKey = 'uuidTipoAdquisicion';
    public $incrementing = false;
    protected $fillable = [
        'uuidLinea',
        'uuidTipoAdquisicion',
        'Cantidad',
        'NoActivo',
        'uuidTipoActivoFijo',
        'uuidTipoBien',
        'uuidArea',
        'CostoSinIva',
        'CostoConIva',
        'DepreciacionAcumulada',
        'FechaEntrada',
        'FechaUltimaActualizacion',
        'VidaUtil',
        'uuidLinea',
        'uuidProveedor',
        'CodigoContable',
        'FechaDeUso',
        'ClaveInterior',
        'DescripcionTipoActivoFijo', // no debería de estar
        'RutaFactura',
        'NumFactura',
        'ConfirmacionCoordinacionBM',
        'DescripcionTipoActivoFijo',
        'uuidProveedor',
        'Folio'
    ];

    public function documentos()
    {
        return $this->morphMany(Documentos::class, 'documentable');
    }

    public function tipoAdquisicion()
    {
        return $this->belongsTo(TiposAdquisicion::class, 'uuidTipoAdquisicion');
    }
}






