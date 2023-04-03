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
        //  $menus = Menus::get()->toArray(); en arreglo
        return $menus;
    }

    // insert
    public function store(Request $request)
    {

        // Creamos un objeto de tipo Producto
        $nuevo_menu = new Menus();
        // Añadimos los parámetros recibidos por el formulario
        $nuevo_menu->uuid = $request->uuid;
        $nuevo_menu->cve = $request->cve;
        $nuevo_menu->nombre = $request->nombre;
        $nuevo_menu->descripcion = $request->descripcion;
        $nuevo_menu->icono = $request->icono;
        $nuevo_menu->path = $request->path;
        $nuevo_menu->nivel = $request->nivel;
        $nuevo_menu->ordenamiento = $request->ordenamiento;

        // Guardamos el producto
        $nuevo_menu->save();
        $data = json_encode($nuevo_menu);
        return $data;
    }

    // update registro
    public function update(Request $request)
    {
        $menus = Menus::find($request->uuid);

        try {
            $menus->update([
                'cve' => $request->cve,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'icono' => $request->icono,
                'path' => $request->path,
                'nivel' => $request->nivel,
                'ordenamiento' => $request->ordenamiento
                ]);
        
                $menus->uuid;
                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        return $menus;

    }
    public function destroy(string $uuid)
    {
        // Buscamos el menu a eliminar 
        // Find busca el id que le pasamos es decir si $producto = 1, buscará id = 1
        $menu = Menus::find($uuid); 

        // eliminamos el menu
        $menu->delete();

        return $menu;
    }
}
