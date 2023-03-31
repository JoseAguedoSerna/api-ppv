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

    /**
    * Show the form for creating a new resource.    
    */
    public function create()
    {
        return view('menus.create');
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
    public function show(string $uuid)
    {
        return view('menus.show',compact('uuid'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function edit(Menus $menus)
    {
        return view('menus.edit',compact('menus'));
    }


    // update registro
    public function update(Request $request, string $uuid)
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
    public function destroy(string $uuid)
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
