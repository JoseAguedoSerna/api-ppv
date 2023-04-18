<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuarios;

use Throwable;

class MenusController extends Controller
{
    // obtiene todos los registros
    public function index(Request $request)
    {
        $menu = Menus::all();
        return $menu;
    }   
    // insert
    public function store(Request $request)
    {
        $nuevo_menu = new Menus();
        try {
            $nuevo_menu::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'Icono' => $request->icono,
                'Path' => $request->path,
                'Nivel' => $request->nivel,
                'Ordenamiento' => $request->ordenamiento,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstMenu = Menus::latest('uuid', 'asc')->first();
        $data = json_encode($firstMenu);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $menu = Menus::find($request->uuid);
        try {
            $menu->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'Icono' => $request->icono,
                'Path' => $request->path,
                'Nivel' => $request->nivel,
                'Ordenamiento' => $request->ordenamiento,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
                $menu->uuid;
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($menu);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $menu = Menus::find($request->uuid); 
        $menu->Delete();
        return $menu;
    }

    public function generaMenusUsuario(Request $request)
    {

        $usuario = Usuarios::find($request->IdUsuario);
        $perfiles = $usuario->perfiles;

        $menus = $usuario->perfiles->flatMap(function($perfil) {
            return $perfil->roles->flatMap(function($rol) {
                return $rol->menus;
            });
        });

        return $menus;
    }
}
