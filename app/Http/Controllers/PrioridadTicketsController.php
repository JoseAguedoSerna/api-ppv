<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PrioridadTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class PrioridadTicketsController extends Controller
{
    // obtiene todos los registros
    public function index(Request $request)
    {
        $ptickets = PrioridadTickets::paginate(10);
        return response()->json([
            'data' => $ptickets->toArray(),
            'current_page' => $ptickets->currentPage(),
            'last_page' => $ptickets->lastPage(),
            'total' => $ptickets->total()
        ]);
        //return $articulo;
    }
    public function show(Request $request)
    {
        $ptickets = PrioridadTickets::where('nombre',$request->nombre)->get();
        return json_encode($ptickets);
    }        
    // insert
    public function store(Request $request)
    {
        $nuevo_ptickets = new PrioridadTickets();
        try {
            $nuevo_ptickets::create([
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
        $firstPTickets = PrioridadTickets::latest('uuid', 'asc')->first();
        $data = json_encode($firstPTickets);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $ptickets = PrioridadTickets::find($request->uuid);
        try {
            $ptickets->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,               
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $ptickets->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($ptickets);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $ptickets = PrioridadTickets::find($request->uuid); 
        $ptickets->Delete();
        return $ptickets;
    }
}
