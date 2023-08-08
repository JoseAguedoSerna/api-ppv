<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
class ProveedoresController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){ 
            $proveedor = Proveedores::all(); } 
            else { 
                $proveedor = Proveedores::paginate($request->perpage); 
            } return response()->json($proveedor);
    }
    
    public function show(Request $request)
    {
        $detalle = Proveedores::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_pr
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Proveedores'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           oveedor = new Proveedores();
        try {
            $nuevo_proveedor::create([
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
        $firstProveedor = Proveedores::latest('uuid', 'asc')->first();
        $data = json_encode($firstProveedor);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $proveedor = Proveedores::find($request->uuid);
        try {
            $proveedor->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $proveedor->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($proveedor);
        return $data;
    }
    public function destroy(Request $request)
    {
        $proveedor = Proveedores::find($request->uuid); 
        $proveedor->Delete();
        return $proveedor;
    }
}
