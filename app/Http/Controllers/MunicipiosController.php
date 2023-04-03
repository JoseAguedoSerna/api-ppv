<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Municipios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class MunicipiosController extends Controller
{
    // obtiene todos los Municipios
    public function index()
    {
        $municipio = Municipios::all();
        return $municipio;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo Municipios
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
        // Buscamos el empleado a eliminar 
        $municipio = Municipios::find($request->uuid); 
        $municipio->Delete();
        return $municipio;
    }
}
