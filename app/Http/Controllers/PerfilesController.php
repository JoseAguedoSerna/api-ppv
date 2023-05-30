<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Perfiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class PerfilesController extends Controller
{
    // public function index()
    // {
    //     $perfil = Perfiles::all();
    //     return $perfil;
    // }

    
    public function index()
    {
        $perfil = Perfiles::paginate(10);
        return response()->json([
            'data' => $perfil->toArray(),
            'current_page' => $perfil->currentPage(),
            'last_page' => $perfil->lastPage(),
            'total' => $perfil->total()
        ]);
    }
    public function show(Request $request)
    {
        $detalle = Articulos::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_perfil = new Perfiles();
        try {
            $nuevo_perfil::create([
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
        $firstPerfil = Perfiles::latest('uuid', 'asc')->first();
        $data = json_encode($firstPerfil);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $perfil = Perfiles::find($request->uuid);
        try {
            $perfil->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $perfil->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($perfil);
        return $data;
    }
    public function destroy(Request $request)
    {
        $perfil = Perfiles::find($request->uuid); 
        $perfil->Delete();
        return $perfil;
    }
}
