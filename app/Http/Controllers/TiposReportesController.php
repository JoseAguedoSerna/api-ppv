<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposReportes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposReportesController extends Controller
{
    // obtiene todos los TiposReportes
    public function index()
    {
        $treporte = TiposReportes::all();
        return $treporte;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo TiposReportes
        $nuevo_treporte = new TiposReportes();
        try {
            $nuevo_treporte::create([
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
        $firstTReporte = TiposReportes::latest('uuid', 'asc')->first();
        $data = json_encode($firstTReporte);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $treporte = TiposReportes::find($request->uuid);
        try {
            $treporte->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $treporte->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($treporte);
        return $data;
    }
    public function destroy(Request $request)
    {
        // Buscamos el empleado a eliminar 
        $treporte = TiposReportes::find($request->uuid); 
        $treporte->Delete();
        return $treporte;
    }
}
