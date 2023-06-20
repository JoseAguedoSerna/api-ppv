<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidaNCampoStoreRequest;
use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmpleadosController extends Controller
{
    // public function index()
    // {
    //     $empleado = Empleados::all();
    //     return $empleado;
    // }

    public function index(Request $request)
    {
        if(!$request->perpage){
            $tdependencias = Empleados::all(); }
        else {
            $tdependencias = Empleados::paginate($request->perpage);
        } return response()->json($tdependencias);
    }

    public function show(Request $request)
    {
        $detalle = Articulos::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Empleados'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data' => $e->validator->extensions
            ], 400));
        }

        $nuevo_empleado = new Empleados();
        try {
            $nuevo_empleado::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'ApellidoPaterno' => $request->ApellidoPaterno,
                'ApellidoMaterno' => $request->ApellidoMaterno,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
        } catch (Throwable $e) {
            abort(403, $e->getMessage());
        }
        $firstEmpleado = Empleados::latest('uuid', 'asc')->first();
        $data = json_encode($firstEmpleado);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $id = $request->uuid;
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Empleados,uuid,'.$id
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data' => $e->validator->errors()
            ], 400);
        }




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
