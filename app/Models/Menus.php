<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class Menus extends Model
{
    use HasFactory;

    // select all
    public static function getAll(){
        return DB::select("CALL sp_GetMenus");
    }
    // select con uuid
    public static function getByUuid(string $uuid){
        return DB::select('CALL sp_GetMenusByUuid(?)', [$uuid]);
    }
    // update registro
    public static function putByUuid(string $uuid, string $descripcion, int $estatus){
        return DB::statement('CALL sp_PutMenus(?, ?, ?)', [$uuid, $descripcion, $estatus]);
    }
    // insertar registro
    public static function post(string $descripcion){
        return DB::statement('CALL sp_PostMenus(?)', [$descripcion]);
    }
    // update deleted - eliminado logico
    public static function deleteDestroy(string $uuid){
        return DB::statement('CALL sp_DeleteMenus(?)', [$uuid]);
    }    
}
