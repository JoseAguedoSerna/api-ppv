<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenusController;
use App\Http\Controllers\DependenciasController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\EntidadesFederativasController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\MunicipiosController;
use App\Http\Controllers\NivelReportesController;
use App\Http\Controllers\NotificacionesController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// post manda datos
// get obtener datos
// update envia actualiza datos
// delete envia actualiza estatus
// TODOS los catalogos
Route::prefix('catalogos')->group(function (){
    #Menus
    Route::get('obtienemenus',[MenusController::class,'index']);
    Route::post('guardamenus',[MenusController::class,'store']);
    Route::post('actualizamenus',[MenusController::class,'update']);
    Route::post('eliminamenus',[MenusController::class,'destroy']);
    #Dependencias
    Route::get('obtienedependencias',[DependenciasController::class,'index']);
    Route::post('guardadependencias',[DependenciasController::class,'store']);
    Route::post('actualizadependencias',[DependenciasController::class,'update']);
    Route::post('eliminadependencias',[DependenciasController::class,'destroy']);
    #Empleados
    Route::get('obtieneempleados',[EmpleadosController::class,'index']);
    Route::post('guardaempleados',[EmpleadosController::class,'store']);
    Route::post('actualizaempleados',[EmpleadosController::class,'update']);
    Route::post('eliminaempleados',[EmpleadosController::class,'destroy']);
    #EntFederativas
    Route::get('obtieneentfederativas',[EntidadesFederativasController::class,'index']);
    Route::post('guardaentfederativas',[EntidadesFederativasController::class,'store']);
    Route::post('actualizaentfederativas',[EntidadesFederativasController::class,'update']);
    Route::post('eliminaentfederativas',[EntidadesFederativasController::class,'destroy']);
    #Marcas
    Route::get('obtienemarcas',[MarcasController::class,'index']);
    Route::post('guardamarcas',[MarcasController::class,'store']);
    Route::post('actualizamarcas',[MarcasController::class,'update']);
    Route::post('eliminamarcas',[MarcasController::class,'destroy']);
    #Municipios
    Route::get('obtienemunicipios',[MunicipiosController::class,'index']);
    Route::post('guardamunicipios',[MunicipiosController::class,'store']);
    Route::post('actualizamunicipios',[MunicipiosController::class,'update']);
    Route::post('eliminamunicipios',[MunicipiosController::class,'destroy']);
    #NivelReportes
    Route::get('obtienenivelreportes',[NivelReportesController::class,'index']);
    Route::post('guardanivelreportes',[NivelReportesController::class,'store']);
    Route::post('actualizanivelreportes',[NivelReportesController::class,'update']);
    Route::post('eliminanivelreportes',[NivelReportesController::class,'destroy']);
    #Notificaciones
    Route::get('obtienenotificaciones',[NotificacionesController::class,'index']);
    Route::post('guardanotificaciones',[NotificacionesController::class,'store']);
    Route::post('actualizanotificaciones',[NotificacionesController::class,'update']);
    Route::post('eliminanotificaciones',[NotificacionesController::class,'destroy']);
});
