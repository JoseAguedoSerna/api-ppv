<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposProveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
class TiposProveedoresController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $tproveedor = TiposProveedores::all();
        }else{
            $tproveedor = TiposProveedores::paginate($request->perpage);
        }
        return response()->json($tproveedor);
    }
    public function show(Request $request)
    {
        $detalle = TiposProveedores::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\TiposProveedores'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
        $nuevo_tproveedor = new TiposProveedores();
        try {
            $nuevo_tproveedor::create([
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
        $firstTProveedor = TiposProveedores::latest('uuid', 'asc')->first();
        $data = json_encode($firstTProveedor);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tproveedor = TiposProveedores::find($request->uuid);
        try {
            $tproveedor->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tproveedor->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tproveedor);
        return $data;
    }
    public function destroy(Request $request)
    { 
        $tproveedor = TiposProveedores::find($request->uuid); 
        $tproveedor->Delete();
        return $tproveedor;
    }
}
