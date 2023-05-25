<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MotivosBaja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class MotivosBajaController extends Controller
{
    // obtiene todos los registros
    // public function index(Request $request)
    // {
    //     $motivobaja = MotivosBaja::all();
    //     return $motivobaja;
    // }   
    public function index()
    {
        $motivoBaja = MotivosBajas::paginate(10);
        return response()->json([
            'data' => $motivoBaja->toArray(),
            'current_page' => $motivoBaja->currentPage(),
            'last_page' => $motivoBaja->lastPage(),
            'total' => $motivoBaja->total()
        ]);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_motivobaja = new MotivosBaja();
        try {
            $nuevo_motivobaja::create([
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
        $firstMotivoBaja = MotivosBaja::latest('uuid', 'asc')->first();
        $data = json_encode($firstMotivoBaja);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $motivobaja = MotivosBaja::find($request->uuid);
        try {
            $motivobaja->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,                
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $motivobaja->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($motivobaja);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $motivobaja = MotivosBaja::find($request->uuid); 
        $motivobaja->Delete();
        return $motivobaja;
    }
}
