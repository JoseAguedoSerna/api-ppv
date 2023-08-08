<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rangos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
class RangosController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $rangos = Rangos::all();
        }else{
            $rangos = Rangos::paginate($request->perpage);
        }
        return response()->json($rangos);
    }
    public function show(Request $request)
    {
        $detalle = Rangos::where('Tipo',$request->tipo)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_rango = new Rangos();
        try {
            $nuevo_rango::create([
                'Tipo' => $request->tipo,
                'Verde' => $request->verde,
                'Amarillo' => $request->amarillo,
                'Rojo' => $request->rojo,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstRango = Rangos::latest('uuid', 'asc')->first();
        $data = json_encode($firstRango);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $rangos = Rangos::find($request->uuid);
        try {
            $rangos->update([
                'Tipo' => $request->tipo,
                'Verde' => $request->verde,
                'Amarillo' => $request->amarillo,
                'Rojo' => $request->rojo,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor  
                ]);        
                $rangos->uuid;                   
        } catch (Throwable $e) {
            abort(403, $e->getMessage());
        }
        $data = json_encode($rangos);
        return $data;
    }
    public function destroy(Request $request)
    {
        $rangos = Rangos::find($request->uuid); 
        $rangos->Delete();
        return $rangos;
    }
}
