<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EntidadesFederativas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
class EntidadesFederativasController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $entfederativas = EntidadesFederativas::all(); }
        else {
            $entfederativas = EntidadesFederativas::paginate($request->perpage);
        } return response()->json($entfederativas);
    }

    public function show(Request $request)
    {
        $detalle = EntidadesFederativas::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\EntidadesFederativas'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
        $nuevo_entfederativas = new EntidadesFederativas();
        try {
            $nuevo_entfederativas::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstEntFederativas = EntidadesFederativas::latest('uuid', 'asc')->first();
        $data = json_encode($firstEntFederativas);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $entfederativas = EntidadesFederativas::find($request->uuid);
        try {
            $entfederativas->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,               
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $entfederativas->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($entfederativas);
        return $data;
    }
    public function destroy(Request $request)
    {
        $entfederativas = EntidadesFederativas::find($request->uuid); 
        $entfederativas->Delete();
        return $entfederativas;
    }
}
