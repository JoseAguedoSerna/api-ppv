<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidaNCampoStoreRequest;
use App\Models\Procesos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProcesosController extends Controller
{
    public function index(Request $request)
    {
        $proceso = DB::table('Procesos')        
        ->select(['Procesos.*','Rangos.Tipo as Tipo'])
        ->join('Rangos', 'Procesos.uuidRango', '=', 'Rangos.uuid')
        ->whereNull('Procesos.deleted_at')
        ->get();    
        if(!$request->perpage){ 
            $result = $proceso;
        }else{ 
            $result = Procesos::paginate($request->perpage); 
        } 
        return response()->json($result);
    }
    public function show(Request $request)
    {
        $detalle = Procesos::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Procesos'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }
        $nuevo_proceso = new Procesos();
        try {
            $nuevo_proceso::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'uuidRango' => $request->uuidrango,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstProceso = Procesos::latest('uuid', 'asc')->first();
        $data = json_encode($firstProceso);
        return $data;
    }
    public function update(Request $request)
    {
        $proceso = Procesos::find($request->uuid);
        try {
            $proceso->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'uuidRango' => $request->uuidrango,
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
        $proceso = Procesos::find($request->uuid); 
        $proceso->Delete();
        return $proceso;
    }
}
