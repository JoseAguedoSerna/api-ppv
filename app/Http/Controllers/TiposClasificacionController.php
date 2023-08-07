<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposClasificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposClasificacionController extends Controller
{
    public function index(Request $request)
    {

        if (!$request->perpage){
            $tclasificacion = TiposClasificacion::all();
        }
        else{
            $tclasificacion = TiposClasificacion::paginate($request->perpage);
        }

        return $tclasificacion;

    }
    public function show(Request $request)
    {
        $detalle = TiposClasificacion::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\TiposClasificacion'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
        $nuevo_tclasificacion = new TiposClasificacion();
        try {
            $nuevo_tclasificacion::create([
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
        $firstTClasificacion = TiposClasificacion::latest('uuid', 'asc')->first();
        $data = json_encode($firstTClasificacion);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tclasificacion = TiposClasificacion::find($request->uuid);
        try {
            $tclasificacion->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
                $tclasificacion->uuid;
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tclasificacion);
        return $data;
    }
    public function destroy(Request $request)
    {
        $tclasificacion = TiposClasificacion::find($request->uuid);
        $tclasificacion->Delete();
        return $tclasificacion;
    }
}
