<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transacciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TransaccionesController extends Controller
{
    // obtiene todos los Transacciones
    public function index()
    {
        $transaccion = Transacciones::all();
        return $transaccion;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo Transacciones
        $nuevo_transaccion = new Transacciones();
        try {
            $nuevo_transaccion::create([
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
        $firstTransaccion = Transacciones::latest('uuid', 'asc')->first();
        $data = json_encode($firstTransaccion);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $transaccion = Transacciones::find($request->uuid);
        try {
            $transaccion->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $transaccion->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($transaccion);
        return $data;
    }
    public function destroy(Request $request)
    {
        // Buscamos el empleado a eliminar 
        $transaccion = Transacciones::find($request->uuid); 
        $transaccion->Delete();
        return $transaccion;
    }
}
