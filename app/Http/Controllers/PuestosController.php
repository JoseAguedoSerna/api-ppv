<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Puestos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class PuestosController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $puesto = Puestos::all();
        }else{
            $puesto = Puestos::paginate($request->perpage);
        }
        return response()->json($puesto);
    }
    public function show(Request $request)
    {
        $detalle = Puestos::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Puestos'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
        $nuevo_puesto = new Puestos();
        try {
            $nuevo_puesto::create([
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
        $firstPuesto = Puestos::latest('uuid', 'asc')->first();
        $data = json_encode($firstPuesto);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $puesto = Puestos::find($request->uuid);
        try {
            $puesto->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $puesto->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($puesto);
        return $data;
    }
    public function destroy(Request $request)
    {
        $puesto = Puestos::find($request->uuid); 
        $puesto->Delete();
        return $puesto;
    }
}
