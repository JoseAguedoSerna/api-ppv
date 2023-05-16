<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Secretaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class SecretariaController extends Controller
{
    // obtiene todos los registros
    public function index(Request $request)
    {
        $secretaria = Secretaria::all();
        return $secretaria;
    }   
    // insert
    public function store(Request $request)
    {
        $nuevo_Secretaria = new Secretaria();
        try {
            $nuevo_Secretaria::create([
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
        $firstSecretaria = Secretaria::latest('uuid', 'asc')->first();
        $data = json_encode($firstSecretaria);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $secretaria = Secretaria::find($request->uuid);
        try {
            $secretaria->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,               
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $secretaria->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($secretaria);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $secretaria = Secretaria::find($request->uuid); 
        $secretaria->Delete();
        return $secretaria;
    }
}
