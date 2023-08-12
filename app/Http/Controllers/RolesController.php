<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
class RolesController extends Controller
{
    // public function index()
    // {
    //     $rol = Roles::all();
    //     return $rol;
    // }
    public function index(Request $request)
    {
        if(!$request->perpage){
            $rol = Roles::all();
        }else{
            $rol = Roles::paginate($request->perpage);
        }
        return response()->json($rol);
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
                'cve' => 'unique_field:App\Models\Roles'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
        $nuevo_rol = new Roles();
        try {
            $nuevo_rol::create([
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
        $firstRol = Roles::latest('uuid', 'asc')->first();
        $data = json_encode($firstRol);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $rol = Roles::find($request->uuid);
        try {
            $rol->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $rol->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($rol);
        return $data;
    }
    public function destroy(Request $request)
    {
        $rol = Roles::find($request->uuid); 
        $rol->Delete();
        return $rol;
    }
}
