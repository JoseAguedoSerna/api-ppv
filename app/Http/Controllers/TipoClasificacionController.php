<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoClasificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TipoClasificacionController extends Controller
{
    // obtiene todos los TipoClasificacion
    public function index()
    {
        $tclasificacion = TipoClasificacion::all();
        return $tclasificacion;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo TipoClasificacion
        $nuevo_tclasificacion = new TipoClasificacion();
        try {
            $nuevo_tclasificacion::create([
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
        $firstTClasificacion = TipoClasificacion::latest('uuid', 'asc')->first();
        $data = json_encode($firstTClasificacion);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tclasificacion = TipoClasificacion::find($request->uuid);
        try {
            $tclasificacion->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tclasificacion->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tclasificacion);
        return $data;
    }
    public function destroy(Request $request)
    {
        // Buscamos el empleado a eliminar 
        $tclasificacion = TipoClasificacion::find($request->uuid); 
        $tclasificacion->Delete();
        return $tclasificacion;
    }
}
