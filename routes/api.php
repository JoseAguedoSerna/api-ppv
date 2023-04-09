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
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\PresentacionMueblesController;
use App\Http\Controllers\ProcesosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\PuestosController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TipoBienController;
use App\Http\Controllers\TipoClasificacionController;
use App\Http\Controllers\TipoDependenciasController;
use App\Http\Controllers\TipoProveedoresController;
use App\Http\Controllers\TipoProcesosController;
use App\Http\Controllers\TiposReportesController;

use App\Http\Controllers\TiposUsuariosController;
use App\Http\Controllers\TipoTransaccionesController;
use App\Http\Controllers\TransaccionesController;
use App\Http\Controllers\UsuariosController;

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
    Route::get('/example', function () {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Requested-With');
        return 'This route allows CORS requests.';
    });
    
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
    #Perfiles
    Route::get('obtieneperfiles',[PerfilesController::class,'index']);
    Route::post('guardaperfiles',[PerfilesController::class,'store']);
    Route::post('actualizaperfiles',[PerfilesController::class,'update']);
    Route::post('eliminaperfiles',[PerfilesController::class,'destroy']);
    #Permisos
    Route::get('obtienepermisos',[PermisosController::class,'index']);
    Route::post('guardapermisos',[PermisosController::class,'store']);
    Route::post('actualizapermisos',[PermisosController::class,'update']);
    Route::post('eliminapermisos',[PermisosController::class,'destroy']);
    #PresMuebles
    Route::get('obtienepresmuebles',[PresentacionMueblesController::class,'index']);
    Route::post('guardapresmuebles',[PresentacionMueblesController::class,'store']);
    Route::post('actualizapresmuebles',[PresentacionMueblesController::class,'update']);
    Route::post('eliminapresmuebles',[PresentacionMueblesController::class,'destroy']);
    #Procesos
    Route::get('obtieneprocesos',[ProcesosController::class,'index']);
    Route::post('guardaprocesos',[ProcesosController::class,'store']);
    Route::post('actualizaprocesos',[ProcesosController::class,'update']);
    Route::post('eliminaprocesos',[ProcesosController::class,'destroy']);
    #Proveedores
    Route::get('obtieneproveedores',[ProveedoresController::class,'index']);
    Route::post('guardaproveedores',[ProveedoresController::class,'store']);
    Route::post('actualizaproveedores',[ProveedoresController::class,'update']);
    Route::post('eliminaproveedores',[ProveedoresController::class,'destroy']);
    #Puestos
    Route::get('obtienepuestos',[PuestosController::class,'index']);
    Route::post('guardapuestos',[PuestosController::class,'store']);
    Route::post('actualizapuestos',[PuestosController::class,'update']);
    Route::post('eliminapuestos',[PuestosController::class,'destroy']);
    #Reportes
    Route::get('obtienereportes',[ReportesController::class,'index']);
    Route::post('guardareportes',[ReportesController::class,'store']);
    Route::post('actualizareportes',[ReportesController::class,'update']);
    Route::post('eliminareportes',[ReportesController::class,'destroy']);
    #Roles
    Route::get('obtieneroles',[RolesController::class,'index']);
    Route::post('guardaroles',[RolesController::class,'store']);
    Route::post('actualizaroles',[RolesController::class,'update']);
    Route::post('eliminaroles',[RolesController::class,'destroy']);
    #TipoBien
    Route::get('obtienetipobien',[TipoBienController::class,'index']);
    Route::post('guardatipobien',[TipoBienController::class,'store']);
    Route::post('actualizatipobien',[TipoBienController::class,'update']);
    Route::post('eliminatipobien',[TipoBienController::class,'destroy']);
    #TipoClasificacion
    Route::get('obtienetipoclas',[TipoClasificacionController::class,'index']);
    Route::post('guardatipoclas',[TipoClasificacionController::class,'store']);
    Route::post('actualizatipoclas',[TipoClasificacionController::class,'update']);
    Route::post('eliminatipoclas',[TipoClasificacionController::class,'destroy']);
    #TipoDependencias
    Route::get('obtienetipodep',[TipoDependenciasController::class,'index']);
    Route::post('guardatipodep',[TipoDependenciasController::class,'store']);
    Route::post('actualizatipodep',[TipoDependenciasController::class,'update']);
    Route::post('eliminatipodep',[TipoDependenciasController::class,'destroy']);
    #TipoProveedores
    Route::get('obtienetipoprov',[TipoProveedoresController::class,'index']);
    Route::post('guardatipoprov',[TipoProveedoresController::class,'store']);
    Route::post('actualizatipoprov',[TipoProveedoresController::class,'update']);
    Route::post('eliminatipoprov',[TipoProveedoresController::class,'destroy']);
    #TiposProcesos
    Route::get('obtienetipoproc',[TipoProcesosController::class,'index']);
    Route::post('guardatipoproc',[TipoProcesosController::class,'store']);
    Route::post('actualizatipoproc',[TipoProcesosController::class,'update']);
    Route::post('eliminatipoproc',[TipoProcesosController::class,'destroy']);
    #TiposReportes
    Route::get('obtienetiporep',[TiposReportesController::class,'index']);
    Route::post('guardatiporep',[TiposReportesController::class,'store']);
    Route::post('actualizatiporep',[TiposReportesController::class,'update']);
    Route::post('eliminatiporep',[TiposReportesController::class,'destroy']);
    #TiposUsuarios
    Route::get('obtienetiposusr',[TiposUsuariosController::class,'index']);
    Route::post('guardatiposusr',[TiposUsuariosController::class,'store']);
    Route::post('actualizatiposusr',[TiposUsuariosController::class,'update']);
    Route::post('eliminatiposusr',[TiposUsuariosController::class,'destroy']);
    #TipoTransacciones
    Route::get('obtienetipotran',[TipoTransaccionesController::class,'index']);
    Route::post('guardatipotran',[TipoTransaccionesController::class,'store']);
    Route::post('actualizatipotran',[TipoTransaccionesController::class,'update']);
    Route::post('eliminatipotran',[TipoTransaccionesController::class,'destroy']);
    #Transacciones
    Route::get('obtienetran',[TransaccionesController::class,'index']);
    Route::post('guardatran',[TransaccionesController::class,'store']);
    Route::post('actualizatran',[TransaccionesController::class,'update']);
    Route::post('eliminatran',[TransaccionesController::class,'destroy']);
    #Usuarios
    Route::get('obtieneusr',[UsuariosController::class,'index']);
    Route::post('guardausr',[UsuariosController::class,'store']);
    Route::post('actualizausr',[UsuariosController::class,'update']);
    Route::post('eliminausr',[UsuariosController::class,'destroy']);
});
