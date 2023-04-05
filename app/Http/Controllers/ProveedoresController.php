<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class ProveedoresController extends Controller
{
    // obtiene todos los Proveedores
    public function index()
    {
        $proveedor = Proveedores::all();
        return $proveedor;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo Proveedores
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
        // Buscamos el empleado a eliminar 
        $proveedor = Proveedores::find($request->uuid); 
        $proveedor->Delete();
        return $proveedor;
    }
}
