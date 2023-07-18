<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AltasMuebles;
use Illuminate\Support\Str;
use Throwable;
use App\Models\TiposAdquisicion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AltasMueblesController extends Controller
{
    public function index(Request $request)
    {
        $altaMuebles = AltasMuebles::join('TiposAdquisicion', 'AltasMuebles.uuidTipoAdquisicion', '=', 'TiposAdquisicion.uuid')
            ->join('Areas', 'AltasMuebles.uuidArea', '=', 'Areas.uuid')
            ->join('TipoActivoFijo', 'AltasMuebles.uuidTipoActivoFijo', '=', 'TipoActivoFijo.uuid')
            ->select('AltasMuebles.*',AltasMuebles::raw("DATE_FORMAT(AltasMuebles.created_at, '%d-%m-%Y') as FechaCreacion"),'TipoActivoFijo.Nombre as TipoActivoFijoNombre','TiposAdquisicion.Nombre AS TipoAdquisicion','Areas.Nombre AS AreaFisica')
            ->get();
        return $altaMuebles;
    }

    public function store(Request $request)
    {
        if (isset($request->ArchivoFactura)) {
            setlocale(LC_TIME, 'es_ES.UTF-8');
            try {
                $base64File = $request->ArchivoFactura;
                $data = str_replace('data:application/pdf;base64,', '', $base64File);
                $fileData = base64_decode($data);
                $filename = date('Y').'/'.date('m').'/'.uniqid() . '.pdf'; 
                Storage::disk('documentos_base64')->put($filename, $fileData);
                // return response()->json(['link' => url('storage/documentos_base64/'.$filename)], 200);
                
                $RutaFactura = url('storage/documentos_base64/'.$filename);
      
            } catch (\Throwable $th) {
                return $th;
                return response()->json(['error' => 'Error guardado'], 400);
            }
            // storage/documentos_base64/64a4a7a8181a2.pdf
            //$filename
        }


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
            $data['RutaFactura'] =  $RutaFactura;
            
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
    public function confirmafactura(Request $request)
    {
            $confirmaFactura = AltasMuebles::find($request->uuid);
            try {
                $confirmaFactura->update([
                    'ConfirmacionCoordinacionBM' => '1'
                    ]);
                    $confirmaFactura->uuid;
            } catch (Throwable $e) {
                abort(404, $e->getMessage());
            }

            $data = json_encode($confirmaFactura);
            return $data;
    }


    public function uploadfactura(Request $request)
    {

        // return $request->file;
        if (isset($request->ArchivoFactura)) {
            setlocale(LC_TIME, 'es_ES.UTF-8');
            try {
                $base64File = $request->ArchivoFactura;
                $data = str_replace('data:application/pdf;base64,', '', $base64File);
                $fileData = base64_decode($data);
                $filename = date('Y').'/'.date('m').'/'.uniqid() . '.pdf'; 
                Storage::disk('documentos_base64')->put($filename, $fileData);
                return response()->json(['link' => url('storage/documentos_base64/'.$filename)], 200);
                // guardar la ruta en la tabla relacionada de la base de datos
                // guardar el registro en la tabl de altasgastocorriente
            } catch (\Throwable $th) {
                return $th;
                return response()->json(['error' => 'Error guardado'], 400);
            }
            // storage/documentos_base64/64a4a7a8181a2.pdf
            //$filename
        }

        return response()->json(['error' => 'No file found'], 400);
    }
}

