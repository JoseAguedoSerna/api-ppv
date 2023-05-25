<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposBien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposBienController extends Controller
{
    // public function index()
    // {
    //     $tbien = TiposBien::all();
    //     return $tbien;
    // }
    public function index()
    {
        $tbien = TiposBien::paginate(10);
        return response()->json([
            'data' => $tbien->toArray(),
            'current_page' => $tbien->currentPage(),
            'last_page' => $tbien->lastPage(),
            'total' => $tbien->total()
        ]);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_tbien = new TiposBien();
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
        $firstTBien = TiposBien::latest('uuid', 'asc')->first();
        $data = json_encode($firstTBien);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tbien = TiposBien::find($request->uuid);
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
        $tbien = TiposBien::find($request->uuid); 
        $tbien->Delete();
        return $tbien;
    }
}
