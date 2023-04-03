<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class MenusController extends Controller
{
    // obtiene todos los menus
    public function index()
    {
        $menus = Menus::all();
        return $menus;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo Menus
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
    public function destroy(Request $request)
    {
        // Buscamos el menu a eliminar 
        $menu = Menus::find($request->uuid); 
        $menu->Delete();
        return $menu;
    }
}
