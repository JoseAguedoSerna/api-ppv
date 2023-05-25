<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposAdquisicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposAdquisicionController extends Controller
{
    // obtiene todos los registros
    // public function index(Request $request)
    // {
    //     $tadquisicion = TiposAdquisicion::all();
    //     return $tadquisicion;
    // }   
    public function index()
    {
        $tadquisicion = TiposAdquisicion::paginate(10);
        return response()->json([
            'data' => $tadquisicion->toArray(),
            'current_page' => $tadquisicion->currentPage(),
            'last_page' => $tadquisicion->lastPage(),
            'total' => $tadquisicion->total()
        ]);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_tadquisicion = new TiposAdquisicion();
        try {
            $nuevo_tadquisicion::create([
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
        $firstTAdquisicion = TiposAdquisicion::latest('uuid', 'asc')->first();
        $data = json_encode($firstTAdquisicion);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tadquisicion = TiposAdquisicion::find($request->uuid);
        try {
            $tadquisicion->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,               
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tadquisicion->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tadquisicion);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $tadquisicion = TiposAdquisicion::find($request->uuid); 
        $tadquisicion->Delete();
        return $tadquisicion;
    }
}
