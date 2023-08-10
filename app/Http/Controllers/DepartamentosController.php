<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Departamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;


class DepartamentosController extends Controller
{
    public function index(Request $request)
    {
        /*if(!$request->perpage){
            $departamentos = Departamentos::all(); }
        else {
            $departamentos = Departamentos::paginate($request->perpage);
        } return response()->json($departamentos);
        */
        // Obtener los departamentos con el nombre de la dependencia a la que pertenece
        $departamentos = Departamentos::join('Dependencias', 'Departamentos.uuidDependencia', '=', 'Dependencias.uuid')
        ->select('Departamentos.*','Dependencias.Nombre as Dependencia')
        ->get();
        return $departamentos;
    }

    public function show(Request $request)
    {
        $detalle = Departamentos::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }

    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Departamentos'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Registro duplicado',
                'data' => $e->validator->extensions
            ], 400));
        }

        $nuevo_departamento = new Departamentos();
        try {
            $nuevo_departamento::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Direccion' => $request->direccion,
                'Telefono' => $request->telefono,
                'uuidDependencia'=> $request->uuidDependencia,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstDepartamento = Departamentos::latest('uuid', 'asc')->first();
        $data = json_encode($firstDepartamento);
        return $data;

    }
    // update registro
    public function update(Request $request)
    {
        $id = $request->uuid;
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Departamentos,uuid,'.$id
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data' => $e->validator->errors()
            ], 400);
        }	

        $departamentos = Departamentos::find($request->uuid);
        try {
            $departamentos->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Direccion' => $request->direccion,
                'Telefono' => $request->telefono,
                'uuidDependencia'=> $request->uuidDependencia,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $departamentos->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($departamentos);
        return $data;
    }

    
    public function destroy(Request $request)
    {
        $departamento = Departamentos::find($request->uuid); 
        $departamento->Delete();
        return $departamento;
    }
}
