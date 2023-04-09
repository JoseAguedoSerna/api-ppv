<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PresentacionMuebles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class PresentacionMueblesController extends Controller
{
    // obtiene todos los PresentacionMuebles
    public function index()
    {
        $pmuebles = PresentacionMuebles::all();
        return $pmuebles;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo PresentacionMuebles
        $nuevo_pmuebles = new PresentacionMuebles();
        try {
            $nuevo_pmuebles::create([
                'Cve' => $request->cve,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstPMuebles = PresentacionMuebles::latest('uuid', 'asc')->first();
        $data = json_encode($firstPMuebles);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $pmuebles = PresentacionMuebles::find($request->uuid);
        try {
            $pmuebles->update([
                'Cve' => $request->cve,
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
        // Buscamos el empleado a eliminar 
        $pmuebles = PresentacionMuebles::find($request->uuid); 
        $pmuebles->Delete();
        return $pmuebles;
    }
}
