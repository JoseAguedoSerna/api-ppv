<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StatusTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class StatusTicketsController extends Controller
{
    // obtiene todos los registros
    public function index(Request $request)
    {
        $stickets = StatusTickets::paginate(10);
        return response()->json([
            'data' => $stickets->toArray(),
            'current_page' => $stickets->currentPage(),
            'last_page' => $stickets->lastPage(),
            'total' => $stickets->total()
        ]);
        //return $articulo;
    }
    public function show(Request $request)
    {
        $stickets = StatusTickets::where('nombre',$request->nombre)->get();
        return json_encode($stickets);
    }        
    // insert
    public function store(Request $request)
    {
        $nuevo_stickets = new StatusTickets();
        try {
            $nuevo_stickets::create([
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
        $firstSTickets = StatusTickets::latest('uuid', 'asc')->first();
        $data = json_encode($firstSTickets);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $stickets = StatusTickets::find($request->uuid);
        try {
            $stickets->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,               
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $stickets->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($stickets);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $stickets = StatusTickets::find($request->uuid); 
        $stickets->Delete();
        return $stickets;
    }
}
