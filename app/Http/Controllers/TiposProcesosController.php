<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposProcesos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposProcesosController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $tproceso = TiposProcesos::all();
        }else{
            $tproceso = TiposProcesos::paginate($request->perpage);
        }
        return response()->json($tproceso);
    }
    public function show(Request $request)
    {
        $detalle = TiposProcesos::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\TiposProcesos'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
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
