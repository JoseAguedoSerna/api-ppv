<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ResguardosDet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class ResguardosDetController extends Controller
{
    // obtiene todos los registros
    // public function index(Request $request)
    // {
    //     $resguardodet = ResguardoDet::all();
    //     return $resguardodet;
    // }   
    public function index()
    {
        $resguardodet = ResguardoDet::paginate(10);
        return response()->json([
            'data' => $resguardodet->toArray(),
            'current_page' => $resguardodet->currentPage(),
            'last_page' => $resguardodet->lastPage(),
            'total' => $resguardodet->total()
        ]);
    }
    public function show(Request $request)
    {
        $detalle = Articulos::where('uuidResguardo',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_resguardodet = new ResguardosDet();
        try {
            $nuevo_resguardodet::create([
                'uuidResguardo' => $request->uuidresguardo,
                'uuidresguardodet' => $request->uuidresguardodet,
                'Estatus' => $request->estatus,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstResguardoDet = ResguardosDet::latest('uuid', 'asc')->first();
        $data = json_encode($firstResguardoDet);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $resguardodet = ResguardosDet::find($request->uuid);
        try {
            $resguardodet->update([
                'uuidResguardo' => $request->uuidresguardo,
<<<<<<< HEAD:app/Http/Controllers/ResguardoDetController.php
                'uuidresguardodet' => $request->uuidresguardodet,
                'Estatus' => $request->estatus,              
=======
                'uuidArticulo' => $request->uuidarticulo,             
>>>>>>> a44e070f9e6a6ef4b713242b752e21899e148381:app/Http/Controllers/ResguardosDetController.php
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $resguardodet->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($resguardodet);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $resguardodet = ResguardosDet::find($request->uuid); 
        $resguardodet->Delete();
        return $resguardodet;
    }
}
