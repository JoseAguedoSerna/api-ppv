<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Perfiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class PerfilesController extends Controller
{
    // obtiene todos los Perfiles
    public function index()
    {
        $perfil = Perfiles::all();
        return $perfil;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo Perfiles
        $nuevo_perfil = new Perfiles();
        try {
            $nuevo_perfil::create([
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
        $firstPerfil = Perfiles::latest('uuid', 'asc')->first();
        $data = json_encode($firstPerfil);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $perfil = Perfiles::find($request->uuid);
        try {
            $perfil->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $perfil->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($perfil);
        return $data;
    }
    public function destroy(Request $request)
    {
        // Buscamos el empleado a eliminar 
        $perfil = Perfiles::find($request->uuid); 
        $perfil->Delete();
        return $perfil;
    }
}
