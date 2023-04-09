<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoProcesos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TipoProcesosController extends Controller
{
    // obtiene todos los TipoProcesos
    public function index()
    {
        $tproceso = TipoProcesos::all();
        return $tproceso;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo TipoProcesos
        $nuevo_tproceso = new TipoProcesos();
        try {
            $nuevo_tproceso::create([
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
        $firstTProceso = TipoProcesos::latest('uuid', 'asc')->first();
        $data = json_encode($firstTProceso);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tproceso = TipoProcesos::find($request->uuid);
        try {
            $tproceso->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tproceso->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tproceso);
        return $data;
    }
    public function destroy(Request $request)
    {
        // Buscamos el empleado a eliminar 
        $tproceso = TipoProcesos::find($request->uuid); 
        $tproceso->Delete();
        return $tproceso;
    }
}
