<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NivelReportes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class NivelReportesController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $nivelreporte = Nivelreportes::all();
        }else{
            $nivelreporte = Nivelreportes::paginate($request->perpage);
        }
        return response()->json($nivelreporte);
    }
    public function show(Request $request)
    {
        $detalle = Nivelreportes::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_nivelreporte = new NivelReportes();
        try {
            $nuevo_nivelreporte::create([
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
        $firstNivelReporte = NivelReportes::latest('uuid', 'asc')->first();
        $data = json_encode($firstNivelReporte);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $nivelreporte = NivelReportes::find($request->uuid);
        try {
            $nivelreporte->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $nivelreporte->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($nivelreporte);
        return $data;
    }
    public function destroy(Request $request)
    {
        $nivelreporte = NivelReportes::find($request->uuid); 
        $nivelreporte->Delete();
        return $nivelreporte;
    }
}
