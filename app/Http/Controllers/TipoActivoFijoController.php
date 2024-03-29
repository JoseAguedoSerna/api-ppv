<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoActivoFijo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

class TipoActivoFijoController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $tipoactivofijo = TipoActivoFijo::all();
        }else{
            $tipoactivofijo = TipoActivoFijo::paginate($request->perpage);
        }
        return response()->json($tipoactivofijo);
    }
    public function show(Request $request)
    {
        $tipoactivofijo = TipoActivoFijo::where('uuid',$request->uuid)->get();
        return json_encode($tipoactivofijo);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\TipoActivoFijo'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
        $nuevo_tipoactivofijo = new TipoActivoFijo();
        try {
            $nuevo_tipoactivofijo::create([
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
        $firstTipoActivoFijo = TipoActivoFijo::latest('uuid', 'asc')->first();
        $data = json_encode($firstTipoActivoFijo);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tipoactivofijo = TipoActivoFijo::find($request->uuid);
        try {
            $tipoactivofijo->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tipoactivofijo->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tipoactivofijo);
        return $data;
    }
    public function destroy(Request $request)
    {
        $tipoactivofijo = TipoActivoFijo::find($request->uuid); 
        $tipoactivofijo->Delete();
        return $tipoactivofijo;
    }
}
