<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RolMenu;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class RolesMenuController extends Controller
{
    // obtiene todos los RolMenu
    public function index(Request $req)
    {
        $uuidRol=$req->uuidRol;
        $rolmenu = RolMenu::where('uuidRol',$uuidRol)->pluck('uuidMenu');
        $menu = Menus::whereIn('uuid', $rolmenu)->get();
        return $rolmenu;
    }

    public function byRol(Request $req)
    {
        $uuidRol=$req->uuidRol;
        $rolmenu = RolMenu::where('uuidRol',$uuidRol)->get();
        return $rolmenu;
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_rolmenu = new RolMenu();
        try {
            $nuevo_rolmenu::create([
                'uuidRol' => $request->uuidrol,
                'uuidMenu' => $request->uuidmenu,
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstRolMenu = RolMenu::latest('uuid', 'asc')->first();
        $data = json_encode($firstRolMenu);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $listaMenu = $request->listaMenu;
        $idRol = $request->idRol;
        DB::beginTransaction();
        try {
            RolMenu::where('uuidRol', $idRol)->delete();
            foreach ($listaMenu as $m) {
                $nuevo_rolmenu = new RolMenu();
                $nuevo_rolmenu::create([
                    'uuidRol' => $idRol,
                    'uuidMenu' => $m["id"],
                ]);
            }        
            DB::commit();         
        } catch (Throwable $e) {
            DB::rollback();
            abort(404, $e->getMessage());
        }
        return response()->json([
            'message' => 'Updated'
        ]);
    }
    public function destroy(Request $request)
    {
        $rolmenu = RolMenu::find($request->uuid); 
        $rolmenu->Delete();
        return $rolmenu;
    }
}
