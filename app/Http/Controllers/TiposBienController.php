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
    public function index(Request $request)
    {
        if(!$request->perpage){
            $tdependencias = TiposBien::all(); }
        else {
            $tdependencias = TiposBien::paginate($request->perpage);
        } return response()->json($tdependencias);
    }
    public function show(Request $request)
    {
        $detalle = Articulos::where('Cve',$request->cve)->get();
        return json_encode($detalle);
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
