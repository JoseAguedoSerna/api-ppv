<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class UsuariosController extends Controller
{
    // public function index()
    // {
    //     $usuario = Usuarios::all();
    //     return $usuario;
    // }
    public function index()
    {
        $usuario = Usuarios::paginate(10);
        return response()->json([
            'data' => $usuario->toArray(),
            'current_page' => $usuario->currentPage(),
            'last_page' => $usuario->lastPage(),
            'total' => $usuario->total()
        ]);
    }
    public function show(Request $request)
    {
        $detalle = Articulos::where('uuidTiCentral',$request->uuidticentral)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_usuario = new Usuarios();
        try {
            $nuevo_usuario::create([
                'uuidTiCentral' => $request->uuidticentral,
                'uuidDependencia' => $request->uuiddependencia,
                'NombreCorto' => $request->nombrecorto,
                'uuidPuesto' => $request->puesto,
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
        $usuario = Usuarios::find($request->uuid); 
        $usuario->Delete();
        return $usuario;
    }
}
