<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Modelos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class ModelosController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $modelo = Modelos::all();
        }else{
            $modelo = Modelos::paginate($request->perpage);
        }
        return response()->json($modelo);
    }

    public function show(Request $request)
    {
        $detalle = Articulos::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_modelo = new Modelos();
        try {
            $nuevo_modelo::create([
                'uuidMarca' => $request->uuidmarca,
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
        $firstModelo = Modelos::latest('uuid', 'asc')->first();
        $data = json_encode($firstModelo);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $modelo = Modelos::find($request->uuid);
        try {
            $modelo->update([
                'uuidMarca' => $request->uuidmarca,
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $modelo->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($modelo);
        return $data;
    }
    public function destroy(Request $request)
    {
        $modelo = Modelos::find($request->uuid); 
        $modelo->Delete();
        return $modelo;
    }
}
