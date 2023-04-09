<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Procesos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class ProcesosController extends Controller
{
    // obtiene todos los Procesos
    public function index()
    {
        $proceso = Procesos::all();
        return $proceso;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo Procesos
        $nuevo_proceso = new Procesos();
        try {
            $nuevo_proceso::create([
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
        $firstProceso = Procesos::latest('uuid', 'asc')->first();
        $data = json_encode($firstProceso);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $proceso = Procesos::find($request->uuid);
        try {
            $proceso->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $proceso->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($proceso);
        return $data;
    }
    public function destroy(Request $request)
    {
        // Buscamos el empleado a eliminar 
        $proceso = Procesos::find($request->uuid); 
        $proceso->Delete();
        return $proceso;
    }
}
