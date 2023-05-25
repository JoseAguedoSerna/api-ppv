<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permisos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class PermisosController extends Controller
{
    // public function index()
    // {
    //     $permiso = Permisos::all();
    //     return $permiso;
    // }

    public function index()
    {
        $permiso = Permisos::paginate(10);
        return response()->json([
            'data' => $permiso->toArray(),
            'current_page' => $permiso->currentPage(),
            'last_page' => $permiso->lastPage(),
            'total' => $permiso->total()
        ]);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_permiso = new Permisos();
        try {
            $nuevo_permiso::create([
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
        $firstPermiso = Permisos::latest('uuid', 'asc')->first();
        $data = json_encode($firstPermiso);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $permiso = Permisos::find($request->uuid);
        try {
            $permiso->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $permiso->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($permiso);
        return $data;
    }
    public function destroy(Request $request)
    {
        $permiso = Permisos::find($request->uuid); 
        $permiso->Delete();
        return $permiso;
    }
}
