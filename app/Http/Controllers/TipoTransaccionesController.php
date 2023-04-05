<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoTransacciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TipoTransaccionesController extends Controller
{
    // obtiene todos los TipoTransacciones
    public function index()
    {
        $ttransaccion = TipoTransacciones::all();
        return $ttransaccion;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo TipoTransacciones
        $nuevo_ttransaccion = new TipoTransacciones();
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
        $firstTTransaccion = TipoTransacciones::latest('uuid', 'asc')->first();
        $data = json_encode($firstTTransaccion);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $ttransaccion = TipoTransacciones::find($request->uuid);
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
        // Buscamos el empleado a eliminar 
        $ttransaccion = TipoTransacciones::find($request->uuid); 
        $ttransaccion->Delete();
        return $ttransaccion;
    }
}
