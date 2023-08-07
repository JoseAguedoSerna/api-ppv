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
        if(!$request->perpage){
            $stickets = StatusTickets::all();
        }else{
            $stickets = StatusTickets::paginate($request->perpage);
        }
        return response()->json($stickets);
    }
    public function show(Request $request)
    {
        $stickets = StatusTickets::where('Nombre',$request->nombre)->get();
        return json_encode($stickets);
    }        
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\StatusTickets'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
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
