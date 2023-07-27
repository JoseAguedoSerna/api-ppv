<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dependencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;


class DependenciasController extends Controller
{
    public function index(Request $request)
    {
        $Dependencia = DB::table('Dependencias')        
        ->select(['Dependencias.*','TiposDependencias.Nombre as TiposDependencias','Titular.Nombre as Titular','Secretarias.Nombre as Secretarias'])
        ->join('TiposDependencias', 'Dependencias.uuidTipoDependencia', '=', 'TiposDependencias.uuid')
        ->join('Titular', 'Dependencias.uuidTitular', '=', 'Titular.uuid')
        ->join('Secretarias', 'Dependencias.uuidSecretaria', '=', 'Secretarias.uuid')
        ->whereNull('Dependencias.deleted_at')
        ->get();    
        if(!$request->perpage){ 
            $result = $Dependencia;
        }else{ 
                $result = Dependencia::paginate($request->perpage); 
        } 
        return response()->json($result);
    }

    public function show(Request $request)
    {
        $detalle = Dependencias::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }

    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Dependencias'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Registro duplicado',
                'data' => $e->validator->extensions
            ], 400));
        }

        $nuevo_dependencia = new Dependencias();
        try {
            $nuevo_dependencia::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Direccion' => $request->direccion,
                'Telefono' => $request->telefono,

                'uuidTipoDependencia'=> $request->uuidtipodependencia,
                'uuidTitular'=> $request->uuidtitular,
                'uuidSecretaria'=> $request->uuidsecretaria,

                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstDependencia = Dependencias::latest('uuid', 'asc')->first();
        $data = json_encode($firstDependencia);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $id = $request->uuid;
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Dependencias,uuid,'.$id
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data' => $e->validator->errors()
            ], 400);
        }	

        $dependencia = Dependencias::find($request->uuid);
        try {
            $dependencia->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Direccion' => $request->direccion,
                'Telefono' => $request->telefono,

                'uuidTipoDependencia'=> $request->uuidtipodependencia,
                'uuidTitular'=> $request->uuidtitular,
                'uuidSecretaria'=> $request->uuidsecretaria,

                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $dependencia->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($dependencia);
        return $data;
    }
    public function destroy(Request $request)
    {
        $dependencia = Dependencias::find($request->uuid); 
        $dependencia->Delete();
        return $dependencia;
    }
}
