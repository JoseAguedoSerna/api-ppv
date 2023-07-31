<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ValoresSistema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class ValoresSistemaController extends Controller
{
    public function index(Request $request)
    {

        if(!$request->perpage){ 
            $param = ValoresSistema::all(); } 
            else { 
                $param = ValoresSistema::paginate($request->perpage); 
            } return response()->json($param);
    }
    public function show(Request $request)
    {        
        try {
            $param = ValoresSistema::where('Cve',$request->cve)->get();
            return json_encode($param);        
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }     
    }
    
    // update registro
    public function update(Request $request)
    {
        $param = ValoresSistema::find($request->uuid);
        try {
            $param->update([
                'Cve' => $request->cve,
                'Descripcion' => $request->descripcion,
                'Tipo' => $request->tipo,
                'ParamStr' => $request->paramstr,
                'ParamInt' => $request->paramint,
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
}
