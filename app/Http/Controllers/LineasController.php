<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lineas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

class LineasController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $linea = Lineas::all();
        }else{
            $linea = Lineas::paginate($request->perpage);
        }
        return response()->json($linea);
    }
    public function show(Request $request)
    {
        $linea = Lineas::where('uuid',$request->uuid)->get();
        return json_encode($linea);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Lineas'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
        $nuevo_linea = new Lineas();
        try {
            $nuevo_linea::create([
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
        $firstLinea = Lineas::latest('uuid', 'asc')->first();
        $data = json_encode($firstLinea);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $linea = Lineas::find($request->uuid);
        try {
            $linea->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $linea->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($linea);
        return $data;
    }
    public function destroy(Request $request)
    {
        $linea = Lineas::find($request->uuid); 
        $linea->Delete();
        return $linea;
    }
}
