<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoDependencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TipoDependenciasController extends Controller
{
    // obtiene todos los TipoDependencias
    public function index()
    {
        $tdependencias = TipoDependencias::all();
        return $tdependencias;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo TipoDependencias
        $nuevo_tdependencias = new TipoDependencias();
        try {
            $nuevo_tdependencias::create([
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
        $firstTDependencias = TipoDependencias::latest('uuid', 'asc')->first();
        $data = json_encode($firstTDependencias);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tdependencias = TipoDependencias::find($request->uuid);
        try {
            $tdependencias->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tdependencias->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tdependencias);
        return $data;
    }
    public function destroy(Request $request)
    {
        // Buscamos el empleado a eliminar 
        $tdependencias = TipoDependencias::find($request->uuid); 
        $tdependencias->Delete();
        return $tdependencias;
    }
}
