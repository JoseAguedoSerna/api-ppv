<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Areas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

class AreasController extends Controller
{
    public function index()
    {
        $area = Areas::all();
        return $area;
    }
    public function show(Request $request)
    {
        $area = Areas::where('uuid',$request->uuid)->get();
        return json_encode($area);
    }    
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Areas'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        } 
        $nuevo_area = new Areas();
        try {
            $nuevo_area::create([
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
        $firstArea = Areas::latest('uuid', 'asc')->first();
        $data = json_encode($firstArea);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $area = Areas::find($request->uuid);
        try {
            $area->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $area->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($area);
        return $data;
    }
    public function destroy(Request $request)
    {
        $area = Areas::find($request->uuid); 
        $area->Delete();
        return $area;
    }
}
