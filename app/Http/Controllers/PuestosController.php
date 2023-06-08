<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Puestos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class PuestosController extends Controller
{
    // public function index()
    // {
    //     $puesto = Puestos::all();
    //     return $puesto;
    // }

    public function index()
    {
        $puesto = Puestos::paginate(10);
        return response()->json([
            'data' => $puesto->toArray(),
            'current_page' => $puesto->currentPage(),
            'last_page' => $puesto->lastPage(),
            'total' => $puesto->total()
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
        $puesto = Puestos::find($request->uuid); 
        $puesto->Delete();
        return $puesto;
    }
}
