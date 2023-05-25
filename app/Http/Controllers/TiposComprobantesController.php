<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposComprobantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposComprobanteController extends Controller
{
    // public function index()
    // {
    //     $tcomprobante = TiposComprobantes::all();
    //     return $tcomprobante;
    // }
    public function index()
    {
        $tcomprobante = TiposComprobantes::paginate(10);
        return response()->json([
            'data' => $tcomprobante->toArray(),
            'current_page' => $tcomprobante->currentPage(),
            'last_page' => $tcomprobante->lastPage(),
            'total' => $tcomprobante->total()
        ]);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_tcomprobante = new TiposComprobantes();
        try {
            $nuevo_tcomprobante::create([
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
        $firstTComprobante = TiposComprobantes::latest('uuid', 'asc')->first();
        $data = json_encode($firstTComprobante);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tcomprobante = TiposComprobantes::find($request->uuid);
        try {
            $tcomprobante->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tcomprobante->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tcomprobante);
        return $data;
    }
    public function destroy(Request $request)
    {
        $tcomprobante = TiposComprobantes::find($request->uuid); 
        $tcomprobante->Delete();
        return $tcomprobante;
    }
}
