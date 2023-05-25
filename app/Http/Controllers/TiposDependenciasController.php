<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposDependencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposDependenciasController extends Controller
{
    // public function index()
    // {
    //     $tdependencias = TiposDependencias::all();
    //     return $tdependencias;
    // }
    public function index()
    {
        $tdependencias = TiposDependencias::paginate(10);
        return response()->json([
            'data' => $tdependencias->toArray(),
            'current_page' => $tdependencias->currentPage(),
            'last_page' => $tdependencias->lastPage(),
            'total' => $tdependencias->total()
        ]);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_tdependencias = new TiposDependencias();
        try {
            $nuevo_tdependencias::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(403, $e->getMessage());
        }
        $firstTDependencias = TiposDependencias::latest('uuid', 'asc')->first();
        $data = json_encode($firstTDependencias);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tdependencias = TiposDependencias::find($request->uuid);
        try {
            $tdependencias->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tdependencias->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tdependencias);
        return $data;
    }
    public function destroy(Request $request)
    {
        $tdependencias = TiposDependencias::find($request->uuid); 
        $tdependencias->Delete();
        return $tdependencias;
    }
}
