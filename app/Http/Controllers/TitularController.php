<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Titular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

class TitularController extends Controller
{
    // obtiene todos los registros
    public function index(Request $request)
    {

        if(!$request->perpage){ 
            $titular = Titular::all(); } 
            else { 
                $titular = Titular::paginate($request->perpage); 
            } return response()->json($titular);

    }   
    public function show(Request $request)
    {
        $detalle = Titular::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }

    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Titular'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }         
        $nuevo_Titular = new Titular();
        try {
            $nuevo_Titular::create([
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
        $firstTitular = Titular::latest('uuid', 'asc')->first();
        $data = json_encode($firstTitular);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $titular = Titular::find($request->uuid);
        try {
            $titular->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,               
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $titular->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($titular);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $titular = Titular::find($request->uuid); 
        $titular->Delete();
        return $titular;
    }
}
