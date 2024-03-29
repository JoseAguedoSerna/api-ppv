<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

class ActivosController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $activo = Activos::all();
        }else{
            $activo = Activos::paginate($request->perpage);
        }
        return response()->json($activo);
    }

    //Condición WHERE
    public function show(Request $request)
    {
        $detalle = Articulos::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }

    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Activos'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }
        $nuevo_activo = new Activos();
        try {
            $nuevo_activo::create([
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
        $firstActivos = Activos::latest('uuid', 'asc')->first();
        $data = json_encode($firstActivos);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $activo = Activos::find($request->uuid);
        try {
            $activo->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,               
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $activo->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($activo);
        return $data;
    }
    public function destroy(Request $request)
    {
        $activo = Activos::find($request->uuid); 
        $activo->Delete();
        return $activo;
    }
}
