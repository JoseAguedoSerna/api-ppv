<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoriasTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class CategoriasTicketsController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $ctickets = CategoriasTickets::all();
        }else{
            $ctickets = CategoriasTickets::paginate($request->perpage);
        }
        return response()->json($ctickets);
    }
    public function show(Request $request)
    {
        $ctickets = CategoriasTickets::where('Nombre',$request->nombre)->get();
        return json_encode($ctickets);
    }        
    // insert
    public function store(Request $request)
    {
        $nuevo_ctickets = new CategoriasTickets();
        try {
            $nuevo_ctickets::create([
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
        $firstCTickets = CategoriasTickets::latest('uuid', 'asc')->first();
        $data = json_encode($firstCTickets);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $ctickets = CategoriasTickets::find($request->uuid);
        try {
            $ctickets->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,               
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $ctickets->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($ctickets);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $ctickets = CategoriasTickets::find($request->uuid); 
        $ctickets->Delete();
        return $ctickets;
    }
}
