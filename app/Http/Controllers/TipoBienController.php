<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoBien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TipoBienController extends Controller
{
    // obtiene todos los TipoBien
    public function index()
    {
        $tbien = TipoBien::all();
        return $tbien;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo TipoBien
        $nuevo_tbien = new TipoBien();
        try {
            $nuevo_tbien::create([
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
        $firstTBien = TipoBien::latest('uuid', 'asc')->first();
        $data = json_encode($firstTBien);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tbien = TipoBien::find($request->uuid);
        try {
            $tbien->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tbien->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tbien);
        return $data;
    }
    public function destroy(Request $request)
    {
        // Buscamos el empleado a eliminar 
        $tbien = TipoBien::find($request->uuid); 
        $tbien->Delete();
        return $tbien;
    }
}
