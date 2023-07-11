<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Marcas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class MarcasController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $marca = Marcas::all(); }
        else {
            $marca = Marcas::paginate($request->perpage);
        } return response()->json($marca);
    }

    public function show(Request $request)
    {
        $detalle = Marcas::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_marca = new Marcas();
        try {
            $nuevo_marca::create([
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
        $firstMarca = Marcas::latest('uuid', 'asc')->first();
        $data = json_encode($firstMarca);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $marca = Marcas::find($request->uuid);
        try {
            $marca->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
                $marca->uuid;
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($marca);
        return $data;
    }
    public function destroy(Request $request)
    {
        $marca = Marcas::find($request->uuid);
        $marca->Delete();
        return $marca;
    }
}
