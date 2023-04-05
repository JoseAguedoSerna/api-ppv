<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Puestos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class PuestosController extends Controller
{
    // obtiene todos los Puestos
    public function index()
    {
        $puesto = Puestos::all();
        return $puesto;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo Puestos
        $nuevo_puesto = new Puestos();
        try {
            $nuevo_puesto::create([
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
        $firstPuesto = Puestos::latest('uuid', 'asc')->first();
        $data = json_encode($firstPuesto);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $puesto = Puestos::find($request->uuid);
        try {
            $puesto->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $puesto->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($puesto);
        return $data;
    }
    public function destroy(Request $request)
    {
        // Buscamos el empleado a eliminar 
        $puesto = Puestos::find($request->uuid); 
        $puesto->Delete();
        return $puesto;
    }
}
