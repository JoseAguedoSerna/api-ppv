<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\JWT as FirebaseJWT;

use Throwable;

class MenusController extends Controller
{
    // obtiene todos los menus
    public function index(Request $request)
    {
        $token = $request->header('Authorization');

       

        if (!$token) {
            // Token no enviado en los headers
            return response()->json(['mensaje' => 'No se envió el token'], 401);
        }


        if (!$this->validarToken($token)) {
            // Token inválido
            return response()->json(['mensaje' => 'Token inválido'], 401);
        }

        // Token válido, continuar con el código del endpoint
        //return response()->json(['mensaje' => 'Token válido'], 200);
        return $this->validarToken($token);
    
        //$menus = Menus::all();
        //return $menus;
    }

    public function validarToken($token)
    {
        $clave_secreta = '2A95F5CCD11DE255FEE9451BDE568';

        try {
            $decoded = JWT::decode($token, new Key($clave_secreta, 'HS256'), array('HS256'));
        } catch (ExpiredException $e) {
            // Token has expired
            return response()->json(['mensaje' => 'Token expirado'], 401);
        } catch (BeforeValidException $e) {
            // Token is not yet valid
            return response()->json(['mensaje' => 'Token no válido aún'], 401);
        } catch (SignatureInvalidException $e) {
            // Token signature is invalid
            return response()->json(['mensaje' => 'Firma del token inválida'], 401);
        } catch (Exception $e) {
            // Error decoding the token
            return response()->json(['mensaje' => 'Token inválido'], 401);
        }

        // Token is valid
        return $decoded;
    }
    // insert
    public function store(Request $request)
    {
        // Creamos un objeto de tipo Menus
        $nuevo_menu = new Menus();
        try {
            $nuevo_menu::create([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'Icono' => $request->icono,
                'Path' => $request->path,
                'Nivel' => $request->nivel,
                'Ordenamiento' => $request->ordenamiento,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor                
                ]);
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $firstMenu = Menus::latest('uuid', 'asc')->first();
        $data = json_encode($firstMenu);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $menu = Menus::find($request->uuid);
        try {
            $menu->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'Icono' => $request->icono,
                'Path' => $request->path,
                'Nivel' => $request->nivel,
                'Ordenamiento' => $request->ordenamiento,                
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);        
                $menu->uuid;                   
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($menu);
        return $data;
    }
    public function destroy(Request $request)
    {
        // Buscamos el menu a eliminar 
        $menu = Menus::find($request->uuid); 
        $menu->Delete();
        return $menu;
    }
}
