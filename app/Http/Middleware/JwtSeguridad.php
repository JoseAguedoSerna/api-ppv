<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\JWT as FirebaseJWT;

class JwtSeguridad
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        $clave_secreta = '2A95F5CCD11DE255FEE9451BDE568';


       if (!$token) {
            // Token no enviado en los headers
            return response()->json(['mensaje' => 'No se envió el token'], 401);
        }
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
        $request->auth = $decoded ;
        //return $decoded;
        //return response()->json($decoded, 401);
        return $next($request);
    }

}
