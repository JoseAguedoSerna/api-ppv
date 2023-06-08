<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MenuPermiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class MenuPermisoController extends Controller
{
    // obtiene todos los MenuPermiso
    public function index()
    {
        $menupermiso = MenuPermiso::all();
        return $menupermiso;
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_menupermiso = new MenuPermiso();
        try {
            $nuevo_menupermiso::create([
                'uuidMenu' => $request->uuidmenu,
                'uuidPermiso' => $request->uuidpermiso,
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstMenuPermiso = MenuPermiso::latest('uuid', 'asc')->first();
        $data = json_encode($firstMenuPermiso);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $menupermiso = MenuPermiso::find($request->uuid);
        try {
            $menupermiso->update([
                'uuidMenu' => $request->uuidmenu,
                'uuidPermiso' => $request->uuidpermiso,
                ]);        
                $menupermiso->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($menupermiso);
        return $data;
    }
    public function destroy(Request $request)
    {
        $menupermiso = MenuPermiso::find($request->uuid); 
        $menupermiso->Delete();
        return $menupermiso;
    }
}
