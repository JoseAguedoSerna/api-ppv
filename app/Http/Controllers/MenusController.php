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
    public function index()
    {
        // $menu = Menus::all();
        // return $menu;
        try {
            $menu = DB::table('Menus as M1')
            ->leftJoin('Menus as M2', 'M1.MenuPadre', '=', 'M2.uuid')
            ->select('M1.*','M2.Nombre as NomMP')
            ->whereNull('M1.deleted_at')
            ->get();
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        return $menu;

    }

    public function show(Request $request)
    {
        $detalle = Menus::where('Cve',$request->cve)->get();
        return json_encode($detalle);
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
                'MenuPadre' => $request->menupadre,
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

        $menus = Usuarios::join('UsuariosPerfiles as up', 'up.uuidUsuario', '=', 'Usuarios.uuid')
            ->join('PerfilesRoles as pr', 'pr.uuidPerfil', '=', 'up.uuidPerfil')
            ->join('RolesMenus as rm', 'rm.uuidRol', '=', 'pr.uuidRol')
            ->join('Menus as m', 'm.uuid', '=', 'rm.uuidMenu')
            ->where('Usuarios.uuid', $request->uuidUsuario)
            ->select('m.*')
            ->get();


        return $menus;
    }
}
