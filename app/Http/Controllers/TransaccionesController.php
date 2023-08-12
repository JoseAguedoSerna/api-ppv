<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transacciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
class TransaccionesController extends Controller
{
    public function index(Request $request)
    {

        if (!$request->perpage){
            $transaccion = Transacciones::all();
        }
        else{
            $transaccion = Transacciones::paginate($request->perpage);
        }


        return response()->json($transaccion);
    }
    public function show(Request $request)
    {
        $detalle = Transacciones::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }
    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\Transacciones'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }         
        $nuevo_transaccion = new Transacciones();
        try {
            $nuevo_transaccion::create([
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
        $firstTransaccion = Transacciones::latest('uuid', 'asc')->first();
        $data = json_encode($firstTransaccion);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $transaccion = Transacciones::find($request->uuid);
        try {
            $transaccion->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
                $transaccion->uuid;
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($transaccion);
        return $data;
    }
    public function destroy(Request $request)
    {
        $transaccion = Transacciones::find($request->uuid);
        $transaccion->Delete();
        return $transaccion;
    }
}
