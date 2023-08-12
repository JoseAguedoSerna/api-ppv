<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DependenciasTipos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

class DependenciasTiposController extends Controller
{
    // obtiene todos los DependenciasTipos
    public function index()
    {
        $dependenciatipo = DependenciasTipos::all();
        return $dependenciatipo;
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\DependenciasTipos'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }        
        $nuevo_dependenciatipo = new DependenciasTipos();
        try {
            $nuevo_dependenciatipo::create([
                'uuidDependencias' => $request->uuiddependencias,
                'uuidTipoDependencias' => $request->uuidtipodependencias,
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstDependenciaTipos = DependenciasTipos::latest('uuid', 'asc')->first();
        $data = json_encode($firstDependenciaTipos);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $dependenciatipo = DependenciasTipos::find($request->uuid);
        try {
            $dependenciatipo->update([
                'uuidDependencias' => $request->uuiddependencias,
                'uuidTipoDependencias' => $request->uuidtipodependencias,
                ]);        
                $dependenciatipo->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($dependenciatipo);
        return $data;
    }
    public function destroy(Request $request)
    {
        $dependenciatipo = DependenciasTipos::find($request->uuid); 
        $dependenciatipo->Delete();
        return $dependenciatipo;
    }
}
