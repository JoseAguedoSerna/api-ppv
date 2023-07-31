<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposTicketsController extends Controller
{
    // obtiene todos los registros
    public function index(Request $request)
    {
        if(!$request->perpage){
            $ttickets = TiposTickets::all();
        }else{
            $ttickets = TiposTickets::paginate($request->perpage);
        }
        return response()->json($ttickets);
    }
    public function show(Request $request)
    {
        $ttickets = TiposTickets::where('Nombre',$request->nombre)->get();
        return json_encode($ttickets);
    }        
    // insert
    public function store(Request $request)
    {
        $nuevo_ttickets = new TiposTickets();
        try {
            $nuevo_ttickets::create([
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
        $firstTTickets = TiposTickets::latest('uuid', 'asc')->first();
        $data = json_encode($firstTTickets);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $ttickets = TiposTickets::find($request->uuid);
        try {
            $ttickets->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,               
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $ttickets->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($ttickets);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $ttickets = TiposTickets::find($request->uuid); 
        $ttickets->Delete();
        return $ttickets;
    }
}
