<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProcesoSteps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
class ProcesoStepsController extends Controller
{
    public function index(Request $request)
    {
        $proceso = DB::table('ProcesoSteps')        
        ->select(['ProcesoSteps.*','Procesos.Cve AS CveProceso','Procesos.Nombre AS NomProceso',])
        ->join('Procesos', 'ProcesoSteps.uuidProceso', '=', 'Procesos.uuid')
        ->whereNull('ProcesoSteps.deleted_at')
        ->orderBy('CveProceso','asc')
        ->orderBy('ProcesoSteps.Ordenamiento','asc')
        ->get();
        if(!$request->perpage){ 
            $result = $proceso;
        }else{ 
                $result = ProcesoSteps::paginate($request->perpage); 
        } 
        return response()->json($result);      
    }
    public function show(Request $request)
    {
        // $detalle = ProcesoSteps::where('Cve',$request->cve)->get();
        // return json_encode($detalle);
        $proceso = DB::table('ProcesoSteps')        
        ->select(['ProcesoSteps.*','Procesos.Cve AS CveProceso','Procesos.Nombre AS NomProceso',])
        ->join('Procesos', 'ProcesoSteps.uuidProceso', '=', 'Procesos.uuid')
        ->where('uuidProceso',$request->uuidproceso)
        ->whereNull('ProcesoSteps.deleted_at')
        ->orderBy('CveProceso','asc')
        ->orderBy('ProcesoSteps.Ordenamiento','asc')
        ->get();
        if(!$request->perpage){ 
            $result = $proceso;
        }else{ 
                $result = ProcesoSteps::paginate($request->perpage); 
        } 
        return response()->json($result); 



    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\ProcesosSteps'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
        $nuevo_proceso = new ProcesoSteps();
        try {
            $nuevo_proceso::create([
                'uuidProceso' => $request->uuidproceso,
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'Ordenamiento' => $request->ordenamiento,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstProceso = ProcesoSteps::latest('uuid', 'asc')->first();
        $data = json_encode($firstProceso);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $proceso = ProcesoSteps::find($request->uuid);
        try {
            $proceso->update([
                'uuidProceso' => $request->uuidproceso,
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'Ordenamiento' => $request->ordenamiento,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                 
                ]);        
                $proceso->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($proceso);
        return $data;
    }
    public function destroy(Request $request)
    {
        $proceso = ProcesoSteps::find($request->uuid); 
        $proceso->Delete();
        return $proceso;
    }
}
