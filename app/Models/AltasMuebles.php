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
        'uuidTipoAdquisicion',
        'uuidTipoBien',
        'uuidPersonalResguardo',
        'uuidMarca',
        'uuidModelo',
        'uuidArea',
        'uuidConductor',
        'uuidTipoActivoFijo',
        'NoInventario',
        'NoActivo',
        'Cantidad',
        'Descripcion',
        'CostoSinIva',
        'CostoConIva',
        'DepreciacionAcumulada',
        'FechaEntrada',
        'FechaUltimaActualizacion',
        'Placas',
        'Series',
        'Anio',
        'VidaUtil',
            'CvePersonal',
            'CveLinea',
        'DescripcionLinea',
        'CodigoContable',
        'FechaDeUso',
        'ClaveInterior',
        'DescripcionDetalle',
            'DescripcionTipoActivoFijo'
        'RutaFactura',
        'ConfirmacionCoordinacionBM',
        'DescripcionTipoActivoFijo'
    ];

    public function tipoAdquisicion()
    {
        return $this->belongsTo(TiposAdquisicion::class, 'uuidTipoAdquisicion');
    }
}
