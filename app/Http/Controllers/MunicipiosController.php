<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Municipios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class MunicipiosController extends Controller
{
    // public function index()
    // {
    //     $municipio = Municipios::all();
    //     return $municipio;
    // }

    public function index()
    {
        $municipio = Municipios::paginate(10);
        return response()->json([
            'data' => $municipio->toArray(),
            'current_page' => $municipio->currentPage(),
            'last_page' => $municipio->lastPage(),
            'total' => $municipio->total()
        ]);
    }

    public function show(Request $request)
    {
        $detalle = Articulos::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_municipio = new Municipios();
        try {
            $nuevo_municipio::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstMunicipio = Municipios::latest('uuid', 'asc')->first();
        $data = json_encode($firstMunicipio);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $municipio = Municipios::find($request->uuid);
        try {
            $municipio->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $municipio->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($municipio);
        return $data;
    }
    public function destroy(Request $request)
    {
        $municipio = Municipios::find($request->uuid); 
        $municipio->Delete();
        return $municipio;
    }
}
