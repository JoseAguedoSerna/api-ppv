<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoProveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TipoProveedoresController extends Controller
{
    // obtiene todos los TipoProveedores
    public function index()
    {
        $tproveedor = TipoProveedores::all();
        return $tproveedor;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo TipoProveedores
        $nuevo_tproveedor = new TipoProveedores();
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
        $firstTProveedor = TipoProveedores::latest('uuid', 'asc')->first();
        $data = json_encode($firstTProveedor);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tproveedor = TipoProveedores::find($request->uuid);
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
        $tproveedor = TipoProveedores::find($request->uuid); 
        $tproveedor->Delete();
        return $tproveedor;
    }
}
