<?php

namespace App\Http\Controllers;

use App\Http\Requests\AltasMueblesRequest;
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

    public function store(AltasMueblesRequest $request)
    {
        $adquisicionId = $request->input('uuidTipoAdquisicion');

        try {
            $tadquisicion = TiposAdquisicion::findOrFail($adquisicionId);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('El tipo de adquisición no existe.',$e->getMessage(), 404);
        }

        try {
            $data = $request->validated();


            $data['uuid'] = Str::uuid(); // Agregar UUID único

            $nuevoMueble = new AltasMuebles($data);
            $nuevoMueble->uuid = Str::uuid();
            $nuevoMueble->tipoAdquisicion()->associate($tadquisicion);
            $nuevoMueble->save();

        }catch (\Illuminate\Database\QueryException $e){
            return $this->errorResponse('Error SQL Store',$e->getMessage(),422);
        }

        return response()->json($nuevoMueble, 201);

    }
    public function search(Request $request)
    {
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
