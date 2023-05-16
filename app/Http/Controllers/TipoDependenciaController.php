<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoDependencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TipoDependenciaController extends Controller
{
    // obtiene todos los registros
    public function index(Request $request)
    {
        $tdependencia = TipoDependencia::all();
        return $tadquisicion;
    }   
    // insert
    public function store(Request $request)
    {
        $nuevo_tdependencia = new TipoDependencia();
        try {
            $nuevo_tdependencia::create([
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
        $firstTDependencia = TipoDependencia::latest('uuid', 'asc')->first();
        $data = json_encode($firstTDependencia);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tdependencia = TipoDependencia::find($request->uuid);
        try {
            $tdependencia->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,               
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tdependencia->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tdependencia);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $tdependencia = TipoDependencia::find($request->uuid); 
        $tdependencia->Delete();
        return $tdependencia;
    }
}
