<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class ProveedoresController extends Controller
{
    // public function index()
    // {
    //     $proveedor = Proveedores::all();
    //     return $proveedor;
    // }

    public function index()
    {
        $proveedor = Proveedores::paginate(10);
        return response()->json([
            'data' => $proveedor->toArray(),
            'current_page' => $proveedor->currentPage(),
            'last_page' => $proveedor->lastPage(),
            'total' => $proveedor->total()
        ]);
    }
    public function show(Request $request)
    {
        $detalle = Articulos::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_proveedor = new Proveedores();
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
