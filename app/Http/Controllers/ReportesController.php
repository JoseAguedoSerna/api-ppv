<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reportes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class ReportesController extends Controller
{
    // public function index()
    // {
    //     $reporte = Reportes::all();
    //     return $reporte;
    // }

    public function index()
    {
        // $reporte = Reportes::all();
        $reporte = DB::table('Reportes')        
        ->select(['Reportes.*','TiposReportes.Nombre as NomTipoReporte',])
        ->join('TiposReportes', 'Reportes.uuidTipoReporte', '=', 'TiposReportes.uuid')
        ->whereNull('Reportes.deleted_at')
        ->get();

        return $reporte;
        $reporte = Reportes::paginate(10);
        return response()->json([
            'data' => $reporte->toArray(),
            'current_page' => $reporte->currentPage(),
            'last_page' => $reporte->lastPage(),
            'total' => $reporte->total()
        ]);
    }
    public function show(Request $request)
    {
        $detalle = Articulos::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_reporte = new Reportes();
        try {
            $nuevo_reporte::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'uuidTipoReporte' => $request->uuidtiporeporte,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstReporte = Reportes::latest('uuid', 'asc')->first();
        $data = json_encode($firstReporte);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $reporte = Reportes::find($request->uuid);
        try {
            $reporte->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'uuidTipoReporte' => $request->uuidtiporeporte,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $reporte->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($reporte);
        return $data;
    }
    public function destroy(Request $request)
    {
        $reporte = Reportes::find($request->uuid); 
        $reporte->Delete();
        return $reporte;
    }
}
