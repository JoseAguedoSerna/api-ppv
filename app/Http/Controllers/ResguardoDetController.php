<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ResguardoDet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class ResguardoDetController extends Controller
{
    // obtiene todos los registros
    public function index(Request $request)
    {
        $resguardodet = ResguardoDet::all();
        return $resguardodet;
    }   
    // insert
    public function store(Request $request)
    {
        $nuevo_resguardodet = new ResguardoDet();
        try {
            $nuevo_resguardodet::create([
                'uuidResguardo' => $request->uuidresguardo,
                'uuidArticulo' => $request->uuidarticulo,
                'Estatus' => $request->estatus,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstResguardoDet = ResguardoDet::latest('uuid', 'asc')->first();
        $data = json_encode($firstResguardoDet);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $resguardodet = ResguardoDet::find($request->uuid);
        try {
            $resguardodet->update([
                'uuidResguardo' => $request->uuidresguardo,
                'uuidArticulo' => $request->uuidarticulo,
                'Estatus' => $request->estatus,              
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
        $resguardodet = ResguardoDet::find($request->uuid); 
        $resguardodet->Delete();
        return $resguardodet;
    }
}
