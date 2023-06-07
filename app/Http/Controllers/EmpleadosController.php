<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class EmpleadosController extends Controller
{
    // public function index()
    // {
    //     $empleado = Empleados::all();
    //     return $empleado;
    // }

    public function index()
    {
        $empleado = Empleados::paginate(10);
        return response()->json([
            'data' => $empleado->toArray(),
            'current_page' => $empleado->currentPage(),
            'last_page' => $empleado->lastPage(),
            'total' => $empleado->total()
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
        $nuevo_empleado = new Empleados();
        try {
            $nuevo_empleado::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'ApellidoPaterno' => $request->apellidopaterno,
                'ApellidoMaterno' => $request->apellidomaterno,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstEmpleado = Empleados::latest('uuid', 'asc')->first();
        $data = json_encode($firstEmpleado);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $empleado = Empleados::find($request->uuid);
        try {
            $empleado->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'ApellidoPaterno' => $request->apellidopaterno,
                'ApellidoMaterno' => $request->apellidomaterno,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $empleado->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($empleado);
        return $data;
    }
    // delete logico
    public function destroy(Request $request)
    {
        $empleado = empleados::find($request->uuid); 
        $empleado->Delete();
        return $empleado;
    }
}
