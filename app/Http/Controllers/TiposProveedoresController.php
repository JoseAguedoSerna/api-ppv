<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposProveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposProveedoresController extends Controller
{
    // obtiene todos los TiposProveedores
    public function index()
    {
        $tproveedor = TiposProveedores::all();
        return $tproveedor;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo TiposProveedores
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
        // Buscamos el empleado a eliminar 
        $tproveedor = TiposProveedores::find($request->uuid); 
        $tproveedor->Delete();
        return $tproveedor;
    }
}
