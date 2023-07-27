<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class CitasController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $citas = Citas::all(); }
        else {
            $citas = Citas::paginate($request->perpage);
        } return response()->json($citas);
    }

    public function show(Request $request)
    {
        $detalle = Citas::where('NoResguardo',$request->noresguardo)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_citas = new Citas();
        try {
            $nuevo_citas::create([
                'Asunto' => $request->asunto,
                'NoResguardo' => $request->noresguardo,
                'NomResguardante' => $request->nomresguardante,
                'Descripcion' => $request->descripcion,
                'Departamento' => $request->departamento,
                'FechaProgramada' => $request->fechaprogramada,
                'HoraProgramada' => $request->horaprogramada,
                'Estatus' => $request->estatus,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstCitas = Citas::latest('uuid', 'asc')->first();
        $data = json_encode($firstCitas);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $citas = Citas::find($request->uuid);
        try {
            $citas->update([
                'Asunto' => $request->asunto,
                'NoResguardo' => $request->noresguardo,
                'NomResguardante' => $request->nomresguardante,
                'Descripcion' => $request->descripcion,
                'Departamento' => $request->departamento,
                'FechaProgramada' => $request->fechaprogramada,
                'HoraProgramada' => $request->horaprogramada,
                'Estatus' => $request->estatus,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
                $citas->uuid;
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($citas);
        return $data;
    }
    public function destroy(Request $request)
    {
        $citas = Citas::find($request->uuid);
        $citas->Delete();
        return $citas;
    }
}
