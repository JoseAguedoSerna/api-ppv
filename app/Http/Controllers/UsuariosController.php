<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class UsuariosController extends Controller
{
    // obtiene todos los Usuarios
    public function index()
    {
        $usuario = Usuarios::all();
        return $usuario;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo Usuarios
        $nuevo_usuario = new Usuarios();
        try {
            $nuevo_usuario::create([
                'uuidTiCentral' => $request->uuidticentral,
                'uuidDependencia' => $request->uuiddependencia,
                'NombreCorto' => $request->nombrecorto,
                'Puesto' => $request->puesto,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstUsuario = Usuarios::latest('uuid', 'asc')->first();
        $data = json_encode($firstUsuario);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $usuario = Usuarios::find($request->uuid);
        try {
            $usuario->update([
                'uuidTiCentral' => $request->uuidticentral,
                'uuidDependencia' => $request->uuiddependencia,
                'NombreCorto' => $request->nombrecorto,
                'Puesto' => $request->puesto,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $usuario->uuid;                   
        } catch (Throwable $e) {
            abort(403, $e->getMessage());
        }
        $data = json_encode($usuario);
        return $data;
    }
    public function destroy(Request $request)
    {
        // Buscamos el empleado a eliminar 
        $usuario = Usuarios::find($request->uuid); 
        $usuario->Delete();
        return $usuario;
    }
}
