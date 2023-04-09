<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposUsuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposUsuariosController extends Controller
{
    // obtiene todos los TiposUsuarios
    public function index()
    {
        $tusuario = TiposUsuarios::all();
        return $tusuario;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo TiposUsuarios
        $nuevo_tusuario = new TiposUsuarios();
        try {
            $nuevo_tusuario::create([
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
        $firstTUsuario = TiposUsuarios::latest('uuid', 'asc')->first();
        $data = json_encode($firstTUsuario);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tusuario = TiposUsuarios::find($request->uuid);
        try {
            $tusuario->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tusuario->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tusuario);
        return $data;
    }
    public function destroy(Request $request)
    {
        // Buscamos el empleado a eliminar 
        $tusuario = TiposUsuarios::find($request->uuid); 
        $tusuario->Delete();
        return $tusuario;
    }
}
