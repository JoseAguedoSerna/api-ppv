<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PresentacionesMuebles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class PresentacionesMueblesController extends Controller
{
    // obtiene todos los PresentacionesMuebles
    public function index()
    {
        $pmuebles = PresentacionesMuebles::all();
        return $pmuebles;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo PresentacionesMuebles
        $nuevo_pmuebles = new PresentacionesMuebles();
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
        $firstPMuebles = PresentacionesMuebles::latest('uuid', 'asc')->first();
        $data = json_encode($firstPMuebles);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $pmuebles = PresentacionesMuebles::find($request->uuid);
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
        $pmuebles = PresentacionesMuebles::find($request->uuid); 
        $pmuebles->Delete();
        return $pmuebles;
    }
}
