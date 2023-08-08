<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposDependencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

// NTR- hay que revisar si se esta utilizando realmente este


class TiposDependenciasController extends Controller
{
    // obtiene todos los registros
    public function index(Request $request)
    {
        if(!$request->perpage){
            $tdependencia = TiposDependencias::all();
        }else{
            $tdependencia = TiposDependencias::paginate($request->perpage);
        }
        return response()->json($tdependencia);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\TiposDependencias'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }
        $nuevo_tdependencia = new TiposDependencias();
        try {
            $nuevo_tdependencia::create([
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
        $firstTDependencia = TiposDependencias::latest('uuid', 'asc')->first();
        $data = json_encode($firstTDependencia);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tdependencia = TiposDependencias::find($request->uuid);
        try {
            $tdependencia->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
                $tdependencia->uuid;
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tdependencia);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $tdependencia = TiposDependencias::find($request->uuid);
        $tdependencia->Delete();
        return $tdependencia;
    }
}
