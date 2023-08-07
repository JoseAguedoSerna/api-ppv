<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposReportes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposReportesController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $treporte = TiposReportes::all();
        }else{
            $treporte = TiposReportes::paginate($request->perpage);
        }
        return response()->json($treporte);
    }
    public function show(Request $request)
    {
        $detalle = TiposReportes::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\TiposReportes'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
        $nuevo_treporte = new TiposReportes();
        try {
            $nuevo_treporte::create([
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
        $firstTReporte = TiposReportes::latest('uuid', 'asc')->first();
        $data = json_encode($firstTReporte);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $treporte = TiposReportes::find($request->uuid);
        try {
            $treporte->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
                $treporte->uuid;
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($treporte);
        return $data;
    }
    public function destroy(Request $request)
    {
        $treporte = TiposReportes::find($request->uuid);
        $treporte->Delete();
        return $treporte;
    }
}
