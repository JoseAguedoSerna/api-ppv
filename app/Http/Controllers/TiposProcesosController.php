<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposProcesos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposProcesosController extends Controller
{
    // public function index()
    // {
    //     $tproceso = TiposProcesos::all();
    //     return $tproceso;
    // }
    public function index()
    {
        $tproceso = TiposProcesos::paginate(10);
        return response()->json([
            'data' => $tproceso->toArray(),
            'current_page' => $tproceso->currentPage(),
            'last_page' => $tproceso->lastPage(),
            'total' => $tproceso->total()
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
        $nuevo_tproceso = new TiposProcesos();
        try {
            $nuevo_tproceso::create([
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
        $firstTProceso = TiposProcesos::latest('uuid', 'asc')->first();
        $data = json_encode($firstTProceso);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tproceso = TiposProcesos::find($request->uuid);
        try {
            $tproceso->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tproceso->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tproceso);
        return $data;
    }
    public function destroy(Request $request)
    {
        $tproceso = TiposProcesos::find($request->uuid); 
        $tproceso->Delete();
        return $tproceso;
    }
}
