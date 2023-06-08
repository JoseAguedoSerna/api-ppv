<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RolMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class RolMenuController extends Controller
{
    // obtiene todos los RolMenu
    public function index()
    {
        $rolmenu = RolMenu::all();
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
        $rolmenu = RolMenu::find($request->uuid);
        try {
            $rolmenu->update([
                'uuidRol' => $request->uuidrol,
                'uuidMenu' => $request->uuidmenu,
                ]);        
                $rolmenu->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($rolmenu);
        return $data;
    }
    public function destroy(Request $request)
    {
        $rolmenu = RolMenu::find($request->uuid); 
        $rolmenu->Delete();
        return $rolmenu;
    }
}
