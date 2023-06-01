<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PresentacionesMuebles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class PresentacionesMueblesController extends Controller
{
    // public function index()
    // {
    //     $pmuebles = PresentacionesMuebles::all();
    //     return $pmuebles;
    // }

    public function index()
    {
        $pmuebles = PresentacionesMuebles::paginate(10);
        return response()->json([
            'data' => $pmuebles->toArray(),
            'current_page' => $pmuebles->currentPage(),
            'last_page' => $pmuebles->lastPage(),
            'total' => $pmuebles->total()
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
        $nuevo_pmuebles = new PresentacionesMuebles();
        try {
            $nuevo_pmuebles::create([
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
        $firstPMuebles = PresentacionesMuebles::latest('uuid', 'asc')->first();
        $data = json_encode($firstPMuebles);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $pmuebles = PresentacionesMuebles::find($request->uuid);
        try {
            $pmuebles->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $pmuebles->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($pmuebles);
        return $data;
    }
    public function destroy(Request $request)
    {
        $pmuebles = PresentacionesMuebles::find($request->uuid); 
        $pmuebles->Delete();
        return $pmuebles;
    }
}