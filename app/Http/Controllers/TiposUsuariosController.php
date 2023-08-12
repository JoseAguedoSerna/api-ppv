<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TiposUsuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;

class TiposUsuariosController extends Controller
{
    // public function index()
    // {
    //     $tusuario = TiposUsuarios::all();
    //     return $tusuario;
    // }
    public function index()
    {
        $tusuario = TiposUsuarios::paginate(10);
        return response()->json([
            'data' => $tusuario->toArray(),
            'current_page' => $tusuario->currentPage(),
            'last_page' => $tusuario->lastPage(),
            'total' => $tusuario->total()
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
        $nuevo_tusuario = new TiposUsuarios();
        try {
            $nuevo_tusuario::create([
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
        $firstTUsuario = TiposUsuarios::latest('uuid', 'asc')->first();
        $data = json_encode($firstTUsuario);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tusuario = TiposUsuarios::find($request->uuid);
        try {
            $tusuario->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $tusuario->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tusuario);
        return $data;
    }
    public function destroy(Request $request)
    {
        $tusuario = TiposUsuarios::find($request->uuid); 
        $tusuario->Delete();
        return $tusuario;
    }
}
