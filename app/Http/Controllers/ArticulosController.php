<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Articulos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class ArticulosController extends Controller
{
    public function index()
    {
        $articulo = Articulos::paginate(10);

        return response()->json([
            'data' => $articulo->toArray(),
            'current_page' => $articulo->currentPage(),
            'last_page' => $articulo->lastPage(),
            'total' => $articulo->total()
        ]);
        //return $articulo;
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_articulo = new Articulos();
        try {
            $nuevo_articulo::create([
                'uuidTipoComprobante' => $request->uuidtipocomprobante,
                'NoComprobante' => $request->nocomprobante,
                'uuidProveedor' => $request->uuidproveedor,
                'uuidTiposAdquisicion' => $request->uuidtipoadquisicion,
                'FechaFactura' => $request->fechafactura,
                'FechaRecepcion' => $request->fecharecepcion,
                'uuidClasificacion' => $request->uuidclasificacion,
                'QR' => $request->qr,
                'CodigoInterno' => $request->codigointerno,
                'Descripcion' => $request->descripcion,
                'NoSerie' => $request->noserie,
                'uuidMarca' => $request->uuidmarca,
                'uuidModelos' => $request->uuidmodelo,
                'Activo' => $request->activo,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstArticulo = Articulos::latest('uuid', 'asc')->first();
        $data = json_encode($firstArticulo);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $articulo = Articulos::find($request->uuid);
        try {
            $articulo->update([
                'uuidTipoComprobante' => $request->uuidtipocomprobante,
                'NoComprobante' => $request->nocomprobante,
                'uuidProveedor' => $request->uuidproveedor,
                'uuidTiposAdquisicion' => $request->uuidtipoadquisicion,
                'FechaFactura' => $request->fechafactura,
                'FechaRecepcion' => $request->fecharecepcion,
                'uuidClasificacion' => $request->uuidclasificacion,
                'QR' => $request->qr,
                'CodigoInterno' => $request->codigointerno,
                'Descripcion' => $request->descripcion,
                'NoSerie' => $request->noserie,
                'uuidMarca' => $request->uuidmarca,
                'uuidModelos' => $request->uuidmodelo,
                'Activo' => $request->activo,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
                $articulo->uuid;
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($articulo);
        return $data;
    }
    public function destroy(Request $request)
    {
        $articulo = Articulos::find($request->uuid);
        $articulo->Delete();
        return $articulo;
    }
}
