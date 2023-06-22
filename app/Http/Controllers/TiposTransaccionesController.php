<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposTransacciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposTransaccionesController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $ttransaccion = TiposTransacciones::all();
        }else{
            $ttransaccion = TiposTransacciones::paginate($request->perpage);
        }
        return response()->json($ttransaccion);
    }
    public function show(Request $request)
    {
        $detalle = Articulos::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_ttransaccion = new TiposTransacciones();
        try {
            $nuevo_ttransaccion::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstTTransaccion = TiposTransacciones::latest('uuid', 'asc')->first();
        $data = json_encode($firstTTransaccion);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $ttransaccion = TiposTransacciones::find($request->uuid);
        try {
            $ttransaccion->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $ttransaccion->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($ttransaccion);
        return $data;
    }
    public function destroy(Request $request)
    { 
        $ttransaccion = TiposTransacciones::find($request->uuid); 
        $ttransaccion->Delete();
        return $ttransaccion;
    }
}
