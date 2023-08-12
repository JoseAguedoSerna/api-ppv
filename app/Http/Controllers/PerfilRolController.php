<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PerfilRol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class PerfilRolController extends Controller
{
    // obtiene todos los PerfilRol
    public function index()
    {
        $perfilrol = PerfilRol::all();
        return $perfilrol;
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_perfilrol = new PerfilRol();
        try {
            $nuevo_perfilrol::create([
                'uuidPerfil' => $request->uuidperfil,
                'uuidRol' => $request->uuidrol,
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstPerfilRol = PerfilRol::latest('uuid', 'asc')->first();
        $data = json_encode($firstPerfilRol);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $perfilrol = PerfilRol::find($request->uuid);
        try {
            $perfilrol->update([
                'uuidPerfil' => $request->uuidperfil,
                'uuidRol' => $request->uuidrol,
                ]);        
                $perfilrol->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($perfilrol);
        return $data;
    }
    public function destroy(Request $request)
    {
        $perfilrol = PerfilRol::find($request->uuid); 
        $perfilrol->Delete();
        return $perfilrol;
    }
}
