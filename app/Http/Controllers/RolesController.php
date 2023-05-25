<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class RolesController extends Controller
{
    // public function index()
    // {
    //     $rol = Roles::all();
    //     return $rol;
    // }
    public function index()
    {
        $rol = Roles::paginate(10);
        return response()->json([
            'data' => $rol->toArray(),
            'current_page' => $rol->currentPage(),
            'last_page' => $rol->lastPage(),
            'total' => $rol->total()
        ]);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_rol = new Roles();
        try {
            $nuevo_rol::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstRol = Roles::latest('uuid', 'asc')->first();
        $data = json_encode($firstRol);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $rol = Roles::find($request->uuid);
        try {
            $rol->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $rol->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($rol);
        return $data;
    }
    public function destroy(Request $request)
    {
        $rol = Roles::find($request->uuid); 
        $rol->Delete();
        return $rol;
    }
}
