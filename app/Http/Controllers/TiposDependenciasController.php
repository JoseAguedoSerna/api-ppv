<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposDependencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
class TiposDependenciasController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $tdependencias = TiposDependencias::all(); }
            else {
                $tdependencias = TiposDependencias::paginate($request->perpage);
            } return response()->json($tdependencias);

    }

    public function show(Request $request)
    {
        $detalle = TiposDependencias::where('Cve',$request->cve)->get();
        return json_encode($detalle);
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

        $nuevo_tdependencias = new TiposDependencias();
        try {
            $nuevo_tdependencias::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
        } catch (Throwable $e) {
            abort(403, $e->getMessage());
        }
        $firstTDependencias = TiposDependencias::latest('uuid', 'asc')->first();
        $data = json_encode($firstTDependencias);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tdependencias = TiposDependencias::find($request->uuid);
        try {
            $tdependencias->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
                $tdependencias->uuid;
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tdependencias);
        return $data;
    }
    public function destroy(Request $request)
    {
        $tdependencias = TiposDependencias::find($request->uuid);
        $tdependencias->Delete();
        return $tdependencias;
    }
}
