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
            ->join('TipoActivoFijo', 'AltasMuebles.uuidTipoActivoFijo', '=', 'TipoActivoFijo.uuid')
            ->where('AltasMuebles.uuidTipoAdquisicion', $request->uuidTipoAdquisicion)
            ->select('AltasMuebles.*','TipoActivoFijo.Nombre as TipoActivoFijoNombre','TiposAdquisicion.Nombre AS TipoAdquisicion','Areas.Nombre AS AreaFisica')
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
        return $jsonData;
    }
    public function search(Request $request)
    {
        /*
            $altaMuebles = AltasMuebles::join('TiposAdquisicion', 'AltasMuebles.uuidTipoAdquisicion', '=', 'TiposAdquisicion.uuid')
            ->join('Areas', 'AltasMuebles.uuidArea', '=', 'Areas.uuid')
            ->join('TipoActivoFijo', 'AltasMuebles.uuidTipoActivoFijo', '=', 'TipoActivoFijo.uuid')
            ->where('AltasMuebles.uuidTipoAdquisicion', $request->uuidTipoAdquisicion)
            ->select('AltasMuebles.*','TipoActivoFijo.Nombre as TipoActivoFijoNombre','TiposAdquisicion.Nombre AS TipoAdquisicion','Areas.Nombre AS AreaFisica')
            ->get();
        return $altaMuebles;*/
        if($request->input('parametroBusqueda')){
            $altaMuebles = AltasMuebles::join('TiposAdquisicion', 'AltasMuebles.uuidTipoAdquisicion', '=', 'TiposAdquisicion.uuid')
            ->join('TipoActivoFijo', 'AltasMuebles.uuidTipoActivoFijo', '=', 'TipoActivoFijo.uuid')
            ->join('Areas', 'AltasMuebles.uuidArea', '=', 'Areas.uuid')
            ->where('AltasMuebles.NoActivo', 'like', '%'.$request->parametroBusqueda.'%')
            ->orwhere('TiposAdquisicion.Nombre', 'like', '%'.$request->parametroBusqueda.'%')
            ->orwhere('AltasMuebles.Descripcion', 'like', '%'.$request->parametroBusqueda.'%')
            ->orwhere('TipoActivoFijo.Nombre', 'like', '%'.$request->parametroBusqueda.'%')
            ->orwhere('Areas.Nombre', 'like', '%'.$request->parametroBusqueda.'%')
            ->select('AltasMuebles.*','TipoActivoFijo.Nombre as TipoActivoFijoNombre','TiposAdquisicion.Nombre AS TipoAdquisicion','Areas.Nombre AS AreaFisica')
            ->get();
            return $altaMuebles; 
        }else if($request->input('fechaDesde') && $request->input('fechaHasta') ){
            $altaMuebles = AltasMuebles::join('TiposAdquisicion', 'AltasMuebles.uuidTipoAdquisicion', '=', 'TiposAdquisicion.uuid')
            ->join('TipoActivoFijo', 'AltasMuebles.uuidTipoActivoFijo', '=', 'TipoActivoFijo.uuid')
            ->join('Areas', 'AltasMuebles.uuidArea', '=', 'Areas.uuid')
            ->whereBetween('AltasMuebles.created_at', [$request->input('fechaDesde'), $request->input('fechaHasta') ])
            ->select('AltasMuebles.*','TipoActivoFijo.Nombre as TipoActivoFijoNombre','TiposAdquisicion.Nombre AS TipoAdquisicion','Areas.Nombre AS AreaFisica')
            ->get();
            return $altaMuebles; 
        }
    }
}

/*
$noticia = Noticia::where('noticiero_turno','LIKE',"%$ntc_turno%")
                    ->orWhere('noticiero_programa','LIKE',"%$ntc_turno%")
                    ->orWhere('noticiero_fecha','LIKE',"%$ntc_turno%")
                    ->paginate(2);

                    Descripcion
                    No Activo
                    Tipo Adquición
                    Descripcion
                    Tipo Activo Fijo
                    Area Fisica*/