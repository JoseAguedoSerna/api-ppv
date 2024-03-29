<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposComprobantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
class TiposComprobantesController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $tcomprobante = TiposComprobantes::all();
        }else{
            $tcomprobante = TiposComprobantes::paginate($request->perpage);
        }
        return response()->json($tcomprobante);
    }
    public function show(Request $request)
    {
        $detalle = TiposComprobantes::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\TiposComprobantes'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
        $nuevo_tcomprobante = new TiposComprobantes();
        try {
            $nuevo_tcomprobante::create([
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
        $firstTComprobante = TiposComprobantes::latest('uuid', 'asc')->first();
        $data = json_encode($firstTComprobante);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tcomprobante = TiposComprobantes::find($request->uuid);
        try {
            $tcomprobante->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tcomprobante->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tcomprobante);
        return $data;
    }
    public function destroy(Request $request)
    {
        $tcomprobante = TiposComprobantes::find($request->uuid); 
        $tcomprobante->Delete();
        return $tcomprobante;
    }
}
