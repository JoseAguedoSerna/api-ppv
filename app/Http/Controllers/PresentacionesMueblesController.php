<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PresentacionesMuebles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

class PresentacionesMueblesController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $pmuebles = PresentacionesMuebles::all();
        }else{
            $pmuebles = PresentacionesMuebles::paginate($request->perpage);
        }
        return response()->json($pmuebles);
    }
    public function show(Request $request)
    {
        $detalle = PresentacionesMuebles::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\PresentacionesMuebles'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
        $nuevo_pmuebles = new PresentacionesMuebles();
        try {
            $nuevo_pmuebles::create([
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
        $firstPMuebles = PresentacionesMuebles::latest('uuid', 'asc')->first();
        $data = json_encode($firstPMuebles);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $pmuebles = PresentacionesMuebles::find($request->uuid);
        try {
            $pmuebles->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $pmuebles->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($pmuebles);
        return $data;
    }
    public function destroy(Request $request)
    {
        $pmuebles = PresentacionesMuebles::find($request->uuid); 
        $pmuebles->Delete();
        return $pmuebles;
    }
}