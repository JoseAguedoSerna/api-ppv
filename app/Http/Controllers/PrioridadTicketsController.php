<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PrioridadTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

class PrioridadTicketsController extends Controller
{
    // obtiene todos los registros
    public function index(Request $request)
    {
        if(!$request->perpage){
            $ptickets = PrioridadTickets::all();
        }else{
            $ptickets = PrioridadTickets::paginate($request->perpage);
        }
        return response()->json($ptickets);
    }
    public function show(Request $request)
    {
        $ptickets = PrioridadTickets::where('nombre',$request->nombre)->get();
        return json_encode($ptickets);
    }        
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\PrioridadTickets'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
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
