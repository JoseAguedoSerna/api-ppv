<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dependencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class DependenciasController extends Controller
{
    // obtiene todos los dependencias
    public function index()
    {
        $Dependencia = Dependencias::all();
        return $Dependencia;
    }
    public function show(Request $request)
    {
        $detalle = Dependencias::where('uuid',$request->uuid)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_dependencia = new Dependencias();
        try {
            $nuevo_dependencia::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Direccion' => $request->direccion,
                'Telefono' => $request->telefono,

                'uuidTipoDependencia'=> $request->uuidtipodependencia,
                'uuidTitular'=> $request->uuidtitular,
                'uuidSecretaria'=> $request->uuidsecretaria,

                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstDependencia = Dependencias::latest('uuid', 'asc')->first();
        $data = json_encode($firstDependencia);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $dependencia = Dependencias::find($request->uuid);
        try {
            $dependencia->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Direccion' => $request->direccion,
                'Telefono' => $request->telefono,

                'uuidTipoDependencia'=> $request->uuidtipodependencia,
                'uuidTitular'=> $request->uuidtitular,
                'uuidSecretaria'=> $request->uuidsecretaria,

                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $dependencia->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($dependencia);
        return $data;
    }
    public function destroy(Request $request)
    {
        $dependencia = Dependencias::find($request->uuid); 
        $dependencia->Delete();
        return $dependencia;
    }
}
