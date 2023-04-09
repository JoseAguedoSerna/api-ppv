<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notificaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class NotificacionesController extends Controller
{
    // obtiene todos los Notificaciones
    public function index()
    {
        $notificacion = Notificaciones::all();
        return $notificacion;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo Notificaciones
        $nuevo_notificacion = new Notificaciones();
        try {
            $nuevo_notificacion::create([
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
        $firstNotificacion = Notificaciones::latest('uuid', 'asc')->first();
        $data = json_encode($firstNotificacion);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $notificacion = Notificaciones::find($request->uuid);
        try {
            $notificacion->update([
                'Encabezado' => $request->encabezado,
                'Descripcion' => $request->descripcion,
                'Visto' => $request->visto,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $notificacion->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($notificacion);
        return $data;
    }
    public function destroy(Request $request)
    {
        // Buscamos el empleado a eliminar 
        $notificacion = Notificaciones::find($request->uuid); 
        $notificacion->Delete();
        return $notificacion;
    }
}
