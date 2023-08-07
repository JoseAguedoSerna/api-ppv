<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ValoresGlobales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class ValoresGlobalesController extends Controller
{
    public function index()
    {
        try {
            $param = ValoresGlobales::all();
            return $param;
        } catch (Throwable $e) {
            abort(403, $e->getMessage());
        }  
    }
    public function show(Request $request)
    {        
        try {
            $param = ValoresGlobales::where('Cve',$request->cve)->get();
            return json_encode($param);        
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }     
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\ValoresGlobales'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }         
        $nuevo_param = new ValoresGlobales();
        try {
            $nuevo_param::create([
                'Modulo' => $request->modulo,
                'Cve' => $request->cve,
                'Descripcion' => $request->descripcion,
                'Tipo' => $request->tipo,
                'ParamStr' => $request->paramstr,
                'ParamInt' => $request->paramint,
                'ParamFloat' => $request->paramfloat,
                'CreadoPor' => $request->creadopor                
                ]);
        } catch (Throwable $e) {
            abort(403, $e->getMessage());
        }
        $firstParam = ValoresGlobales::latest('uuid', 'asc')->first();
        $data = json_encode($firstParam);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $param = ValoresGlobales::find($request->uuid);
        try {
            $param->update([
                'Modulo' => $request->modulo,
                'Cve' => $request->cve,
                'Descripcion' => $request->descripcion,
                'Tipo' => $request->tipo,
                'ParamStr' => $request->paramstr,
                'ParamInt' => $request->paramint,
                'ParamFloat' => $request->paramfloat,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $param->uuid;                   
        } catch (Throwable $e) {
            abort(405, $e->getMessage());
        }
        $data = json_encode($param);
        return $data;
    }
    public function destroy(Request $request)
    {
        $param = ValoresGlobales::find($request->uuid); 
        $param->Delete();
        return $param;
    }
}
