<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UsuarioPerfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class UsuarioPerfilController extends Controller
{
    // obtiene todos los UsuarioPerfil
    public function index()
    {
        $usuarioperfil = UsuarioPerfil::all();
        return $usuarioperfil;
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_usuarioperfil = new UsuarioPerfil();
        try {
            $nuevo_usuarioperfil::create([
                'uuidUsuario' => $request->uuidusuario,
                'uuidPerfil' => $request->uuidperfil,
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstUsuarioPerfil = UsuarioPerfil::latest('uuid', 'asc')->first();
        $data = json_encode($firstUsuarioPerfil);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $usuarioperfil = UsuarioPerfil::find($request->uuid);
        try {
            $usuarioperfil->update([
                'uuidUsuario' => $request->uuidusuario,
                'uuidPerfil' => $request->uuidperfil,
                ]);        
                $usuarioperfil->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($usuarioperfil);
        return $data;
    }
    public function destroy(Request $request)
    {
        $usuarioperfil = UsuarioPerfil::find($request->uuid); 
        $usuarioperfil->Delete();
        return $usuarioperfil;
    }
}
