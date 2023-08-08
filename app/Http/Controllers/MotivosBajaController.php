<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MotivosBaja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

class MotivosBajaController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $motivoBaja = MotivosBaja::all();
        }else{
            $motivoBaja = MotivosBaja::paginate($request->perpage);
        }
        return response()->json($motivoBaja);
    }

    public function show(Request $request)
    {
        $detalle = MotivosBaja::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\MotivosBaja'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
        $nuevo_motivobaja = new MotivosBaja();
        try {
            $nuevo_motivobaja::create([
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
        $firstMotivoBaja = MotivosBaja::latest('uuid', 'asc')->first();
        $data = json_encode($firstMotivoBaja);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $motivobaja = MotivosBaja::find($request->uuid);
        try {
            $motivobaja->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,                
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $motivobaja->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($motivobaja);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $motivobaja = MotivosBaja::find($request->uuid); 
        $motivobaja->Delete();
        return $motivobaja;
    }
}
