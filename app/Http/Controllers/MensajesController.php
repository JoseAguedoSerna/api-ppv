<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mensajes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class MensajesController extends Controller
{
    public function index()
    {
        $mensaje = Mensajes::all();
        return $mensaje;
    }
    public function show(Request $request)
    {        
        try {
            $mensaje = Mensajes::where('Asignadoa',$request->asignadoa)->get();
            return json_encode($mensaje);        
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }     
    }

    public function new(Request $request)
    {        
        try {
            $mensaje = Mensajes::where('Asignadoa',$request->asignadoa)
                                ->where('Visto',0)
                                ->count('UUID');
                                // ->get();
            return json_encode($mensaje);        
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }     
    }




    // insert
    public function store(Request $request)
    {
        $nuevo_mensaje = new Mensajes();
        try {
            $nuevo_mensaje::create([
                'Asignadoa' => $request->asignadoa,
                'Encabezado' => $request->encabezado,
                'Descripcion' => $request->descripcion,
                'Visto' => $request->visto,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstMensaje = Mensajes::latest('uuid', 'asc')->first();
        $data = json_encode($firstMensaje);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $mensaje = Mensajes::find($request->uuid);
        try {
            $mensaje->update([
                'Asignadoa' => $request->asignadoa,
                'Encabezado' => $request->encabezado,
                'Descripcion' => $request->descripcion,
                'Visto' => $request->visto,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $mensaje->uuid;                   
        } catch (Throwable $e) {
            abort(405, $e->getMessage());
        }
        $data = json_encode($mensaje);
        return $data;
    }

    // Marcar como leido
    public function read(Request $request)
    {
        $mensaje = Mensajes::find($request->uuid);
        try {
            $mensaje->update(['Visto' => '1']);        
                $mensaje->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($mensaje);
        return $data;
    }



    public function destroy(Request $request)
    {
        $mensaje = Mensajes::find($request->uuid); 
        $mensaje->Delete();
        return $mensaje;
    }
}
