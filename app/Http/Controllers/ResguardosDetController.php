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
    public function index(Request $request)
    {
        $resguardodet = ResguardosDet::all();
        return $resguardodet;
    }   
    // insert
    public function store(Request $request)
    {
        $nuevo_resguardodet = new ResguardosDet();
        try {
            $nuevo_resguardodet::create([
                'uuidResguardo' => $request->uuidresguardo,
                'uuidArticulo' => $request->uuidarticulo,
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
                'uuidArticulo' => $request->uuidarticulo,             
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
