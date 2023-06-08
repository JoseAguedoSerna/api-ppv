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
    // public function index()
    // {
    //     $Dependencia = Dependencias::all();
    //     return $Dependencia;
    // }

    public function index()
    {
        // $Dependencia = Dependencias::all();
        // return $Dependencia;
        $Dependencia = DB::table('Dependencias')        
        ->select(['Dependencias.*','TiposDependencias.Nombre as TiposDependencias','Titular.Nombre as Titular','Secretarias.Nombre as Secretarias'])
        ->join('TiposDependencias', 'Dependencias.uuidTipoDependencia', '=', 'TiposDependencias.uuid')
        ->join('Titular', 'Dependencias.uuidTitular', '=', 'Titular.uuid')
        ->join('Secretarias', 'Dependencias.uuidSecretaria', '=', 'Secretarias.uuid')
        ->whereNull('Dependencias.deleted_at')
        ->get();
    
        // $tickets::paginate(10);
        // return response()->json([
        //     'data' => $tickets->toArray(),
        //     'current_page' => $tickets->currentPage(),
        //     'last_page' => $tickets->lastPage(),
        //     'total' => $tickets->total()
        // ]);
        return $Dependencia;


    }
    //public function show(Request $request)
    //{
        //$detalle = Dependencias::where('uuid',$request->uuid)->get();
        //$dependencia = Dependencias::paginate(10);
        //return response()->json([
          //  'data' => $dependencia->toArray(),
          //  'current_page' => $dependencia->currentPage(),
          //  'last_page' => $dependencia->lastPage(),
           // 'total' => $dependencia->total()
        //]);
    //}

    public function show(Request $request)
    {
        $detalle = Articulos::where('Cve',$request->cve)->get();
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
