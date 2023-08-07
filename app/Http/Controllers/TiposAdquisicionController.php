<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposAdquisicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TiposAdquisicionController extends Controller
{
    public function index(Request $request)
    {
        $tadquisicion = DB::table('TiposAdquisicion')        
        ->select(['TiposAdquisicion.*','Procesos.uuid AS uuidProceso','Procesos.Nombre AS NomProceso',])
        ->leftjoin('Procesos', 'TiposAdquisicion.Proceso', '=', 'Procesos.uuid')
        ->whereNull('TiposAdquisicion.deleted_at')
        ->get();
        if(!$request->perpage){ 
            $result = $tadquisicion;
        }else{ 
                $result = TiposAdquisicion::paginate($request->perpage); 
        } 
        return response()->json($result);  
    }
    public function show(Request $request)
    {
        $tadquisicion = TiposAdquisicion::where('uuid',$request->uuid)->get();
        return json_encode($tadquisicion);
    }

    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\TiposAdquisicion'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }           
        $nuevo_tadquisicion = new TiposAdquisicion();
        try {
            $nuevo_tadquisicion::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'Proceso' => $request->proceso,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstTAdquisicion = TiposAdquisicion::latest('uuid', 'asc')->first();
        $data = json_encode($firstTAdquisicion);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tadquisicion = TiposAdquisicion::find($request->uuid);
        try {
            $tadquisicion->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'Proceso' => $request->proceso,               
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tadquisicion->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tadquisicion);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $tadquisicion = TiposAdquisicion::find($request->uuid); 
        $tadquisicion->Delete();
        return $tadquisicion;
    }
}
