<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class MenusController extends Controller
{
    public function index()
    {
        $menus = Menus::getAll();
        return $menus;
    }
    // insert
    public function store(Request $request)
    {
        try {
            $result = Menus::post($uuid, $request->nombre, $request->descripcion, $request->icono, $request->path, $request->nivel, $request->ordenamiento, 
            $request->creadopor, $request->fechacreacion, $request->modificacopor, $request->fechamodificacion, $request->eliminadopor, $request->fechaeliminacino, $request->deleted);
            return response($result);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
    }
    public function show(string $id)
    {
        //
    }
    // update registro
    public function update(Request $request, string $id)
    {
        $menus = Menus::getByUuid($uuid);
        if ($menus) {
            try {
                $result = Menus::putByUuid($uuid, $request->nombre, $request->descripcion, $request->icono, $request->path, $request->nivel, $request->ordenamiento, 
                $request->creadopor, $request->fechacreacion, $request->modificacopor, $request->fechamodificacion, $request->eliminadopor, $request->fechaeliminacino, $request->deleted);
                return response($result);
            } catch (Throwable $e) {
                abort(404, $e->getMessage());
            }
        } else {
            abort(404, 'Menu no encontrada');
        }        
    }
    // update deleted, eliminado logico
    public function destroy(string $id)
    {
        $menus = Menus::getByUuid($uuid);
        if ($menus) {
            try {
                $result = Menus::deleteDestroy($uuid);
                return response($result);
            } catch (Throwable $e) {
                abort(404, $e->getMessage());
            }
        } else {
            abort(404, 'Menu no encontrada');
        }
    }
}
