<?php

namespace App\Http\Controllers;

use App\Http\Requests\AltasMueblesRequest;
use Illuminate\Http\Request;
use App\Models\AltasMuebles;
use Illuminate\Support\Str;
use Throwable;
use App\Models\TiposAdquisicion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Services\DocumentosStorageService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

    public function store(AltasMueblesRequest $request)
    {

        $archivoFactura = $request->file('ArchivoFactura');


        $adquisicionId = $request->input('uuidTipoAdquisicion');

        try {
            $tadquisicion = TiposAdquisicion::findOrFail($adquisicionId);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse('El tipo de adquisición no existe.',$e->getMessage(), 404);
        }

        try {
            $data = $request->validated();


            $data['uuid'] = Str::uuid(); // Agregar UUID único
            

            $nuevoMueble = AltasMuebles::create($data);
            $data = $request->only([
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
                //PorcentajeDepreciacion esta en el form , y no esta en la base de datos
                'Folio',
                'uuidLinea',
                'uuidProveedor',
                'CodigoContable',
                'FechaDeUso',
                'ClaveInterior',
                'NumFactura',
                // Cog, esta en el form pero no esta en la base de datos
                // CveArea esta en el form y ya no deberia de estar  por que ya esta un id de area 
                //'DescripcionDetalle', se quito del form y la tabla por que ya hay un campo de descripcion
                'DescripcionTipoActivoFijo', // no esta en el form y  este ya no deberia de estar ya esta un id de tipo activo fijo
            ]);
            $data['uuid']        = Str::uuid(); // Agregar UUID único
            
            $nuevoMueble         = AltasMuebles::create($data);
            $nuevoMueble->tipoAdquisicion()->associate($tadquisicion);
            $nuevoMueble->save();
            

            $dataLineasDetalles = $request->only([
                'NoInventario',
                'uuidMarca',
                'uuidModelo',
                'Serie',
                'ValorFactura',
                'Descripcion',
                'Condicion',
                'NoInventario' // Pendientes investigar para cambiar el tipo de dato a char y hacer muchas pruebas
            ]);

            // Obtener los campos para la tabla LineasDetallesAlta
            $dataLineasDetalles['uuid']           = Str::uuid();
            $dataLineasDetalles['uuidAltaMueble'] = $data['uuid'];

            DB::table('LineasDetallesAlta')->insert($dataLineasDetalles);


        }catch (\Illuminate\Database\QueryException $e){
            return $this->errorResponse('Error SQL Store',$e->getMessage(),422);
        }

        $idMueble = $nuevoMueble->uuid;

        $this->guardaFacturaV2($archivoFactura, $idMueble);

        return response()->json($nuevoMueble, 201);
        //return $nuevoMueble->uuid;

    }

    public function guardaFacturaV2(\Illuminate\Http\UploadedFile $Factura, $Id)
    {
        $Ruta = env('RUTA_FOLDER_FTP');
        //$Nombre = 'hola.pdf';
        $Nombre = $Factura->getClientOriginalName();


        $documentService = new DocumentosStorageService();

        try {

            $documentService->guardaDocumento($Factura,$Nombre, $Ruta, 'App\Models\AltasMuebles', $Id);

        } catch (\InvalidArgumentException $e) {
            // Capturar la excepción si el modelo relacionado no existe
            return $this->errorResponse('El tipo de adquisición no existe.',$e->getMessage(), 404);
        } catch (\Exception $e) {
            // Capturar cualquier otra excepción
            return $this->errorResponse('El tipo de adquisición no existe.',$e->getMessage(), 404);
        }

    }

    public function descargaFactura(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'IdAltaMueble' => 'required|uuid',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Campo requerido.',$validator->errors(), 422);
        }

        $IdModel = $request->IdAltaMueble;
        $documentService = new  DocumentosStorageService();
        $modelType = 'App\Models\AltasMuebles';
        return $documentService->descargaDocumento($modelType, $IdModel);
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

}
