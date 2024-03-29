<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EstatusResguardo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;
use Illuminate\Http\Exceptions\HttpResponseException;
class EstatusResguardoController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->perpage){
            $estatusresguardo = EstatusResguardo::all();
        }else{
            $estatusresguardo = EstatusResguardo::paginate($request->perpage);
        }
        return response()->json($estatusresguardo);
    }

    public function show(Request $request)
    {
        $detalle = EstatusResguardo::where('Cve',$request->cve)->get();
        return json_encode($detalle);
    }

    // insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cve' => 'unique_field:App\Models\EstatusResguardo'
            ]);
        } catch (Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'El registro ya esta registrado',
                'data' => $e->validator->extensions
            ], 400));
        }
        $nuevo_estatusresguardo = new EstatusResguardo();
        try {
            $nuevo_estatusresguardo::create([
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
        $firstEstatusResguardo = EstatusResguardo::latest('uuid', 'asc')->first();
        $data = json_encode($firstEstatusResguardo);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $estatusresguardo = EstatusResguardo::find($request->uuid);
        try {
            $estatusresguardo->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
                $estatusresguardo->uuid;
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($estatusresguardo);
        return $data;
    }
    public function destroy(Request $request)
    {
        $estatusresguardo = EstatusResguardo::find($request->uuid);
        $estatusresguardo->Delete();
        return $estatusresguardo;
    }
}
