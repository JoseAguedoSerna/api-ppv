<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Resguardos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class ResguardosController extends Controller
{
    // // obtiene todos los registros
    // public function index(Request $request)
    // {
    //     $resguardo = Resguardos::all();
    //     return $resguardo;
    // }   
    public function index()
    {
        $resguardo = Resguardos::paginate(10);
        return response()->json([
            'data' => $resguardo->toArray(),
            'current_page' => $resguardo->currentPage(),
            'last_page' => $resguardo->lastPage(),
            'total' => $resguardo->total()
        ]);
    }

    public function show(Request $request)
    {
        $detalle = Articulos::where('uuidTipoComprobante',$request->uuidtipocomprobante)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_resguardo = new Resguardos();
        try {
            $nuevo_resguardo::create([
                'uuidTipoComprobante' => $request->uuidtipocomprobante,
                'NoComprobante' => $request->nocomprobante,
                'uuidProveedor' => $request->uuidproveedor,
                'FechaFactura' => $request->fechafactura,
                'FechaRecepcion' => $request->fecharecepcion,
                'Descripcion' => $request->descripcion,
                'uuidTipoAdquisicion' => $request->uuidtipoadquisicion,
                'AñoCompra' => $request->añocompra,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstResguardo = Resguardos::latest('uuid', 'asc')->first();
        $data = json_encode($firstResguardo);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $resguardo = Resguardos::find($request->uuid);
        try {
            $resguardo->update([
                'uuidTipoComprobante' => $request->uuidtipocomprobante,
                'NoComprobante' => $request->nocomprobante,
                'uuidProveedor' => $request->uuidproveedor,
                'FechaFactura' => $request->fechafactura,
                'FechaRecepcion' => $request->fecharecepcion,
                'Descripcion' => $request->descripcion,
                'uuidTipoAdquisicion' => $request->uuidtipoadquisicion,
                'AñoCompra' => $request->añocompra,              
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $resguardo->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($resguardo);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $resguardo = Resguardos::find($request->uuid); 
        $resguardo->Delete();
        return $resguardo;
    }
}
