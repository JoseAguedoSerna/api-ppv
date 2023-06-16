<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AltasMuebles;
use Illuminate\Support\Str;
use Throwable;
use App\Models\TiposAdquisicion;

class AltasMueblesController extends Controller
{
    public function index(Request $request)
    {
        $altaMuebles = AltasMuebles::join('TiposAdquisicion', 'AltasMuebles.uuidTipoAdquisicion', '=', 'TiposAdquisicion.uuid')
            ->join('Areas', 'AltasMuebles.uuidArea', '=', 'Areas.uuid')
            ->where('AltasMuebles.uuidTipoAdquisicion', $request->uuidTipoAdquisicion)
            ->select('AltasMuebles.*','TiposAdquisicion.Nombre AS Tipo Adquisicion','Areas.Nombre AS Area Fisica')
            ->get();
        return $altaMuebles;
    }

    public function store(Request $request)
    {
        $adquisicionId = $request->input('uuidTipoAdquisicion');
        $tadquisicion = TiposAdquisicion::findOrFail($adquisicionId);
        try {
            $data = $request->only([
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
            ]);

            $data['uuid'] = Str::uuid(); // Agregar UUID único

            $nuevoMueble = AltasMuebles::create($data);
            $nuevoMueble->tipoAdquisicion()->associate($tadquisicion);
            $nuevoMueble->save();

        }   catch (\Illuminate\Database\QueryException $ex){
            return response('Error en base de datos: '.$ex->getMessage(), 400)
                ->header('Content-Type', 'text/plain');
        }

        $jsonData = $nuevoMueble->toJson();
        return $tadquisicion;
        //return $jsonData;
    }
}
