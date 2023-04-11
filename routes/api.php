<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtSeguridad;

use App\Http\Controllers\{
    #menus
    MenusController,
    DependenciasController,
    EmpleadosController,
    EntidadesFederativasController,
    MarcasController,
    MunicipiosController,
    NivelReportesController,
    NotificacionesController,
    PerfilesController,
    PermisosController,
    PresentacionesMueblesController,
    ProcesosController,
    ProveedoresController,
    PuestosController,
    ReportesController,
    RolesController,
    TiposBienController,
    TiposClasificacionController,
    TiposDependenciasController,
    TiposProveedoresController,
    TiposProcesosController,
    TiposReportesController,
    TiposUsuariosController,
    TiposTransaccionesController,
    TransaccionesController,
    UsuariosController,
    #Muebles
    ActivosController,
    ArticulosController,
    MarcasMueblesController,
    ModelosController,
    MotivosBajaController,
    // PresentacionesMueblesController,
    ResguardosController,
    ResguardoDetController,
    TiposAdquisicionController,
    // TiposBienController,
    // TiposClasificacionController,
    TiposComprobantesController
};
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// post manda datos
// get obtener datos
// update envia actualiza datos
// delete envia actualiza estatus
// TODOS los catalogos

Route::middleware(JwtSeguridad::class)->group(function () {
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
        #MarcasMuebles
            Route::get('obtienemarcasmuebles',[MarcasMueblesController::class,'index']);
            Route::post('guardamarcasmuebles',[MarcasMueblesController::class,'store']);
            Route::post('actualizamarcasmuebles',[MarcasMueblesController::class,'update']);
            Route::post('eliminamarcasmuebles',[MarcasMueblesController::class,'destroy']);
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
        #PresentacionesMuebles
            Route::get('obtienepresentacionesmuebles',[PresentacionesMueblesController::class,'index']);
            Route::post('guardapresentacionesmuebles',[PresentacionesMueblesController::class,'store']);
            Route::post('actualizapresentacionesmuebles',[PresentacionesMueblesController::class,'update']);
            Route::post('eliminapresentacionesmuebles',[PresentacionesMueblesController::class,'destroy']);    
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
        #TiposBien
            Route::get('obtienetipobien',[TiposBienController::class,'index']);
            Route::post('guardatipobien',[TiposBienController::class,'store']);
            Route::post('actualizatipobien',[TiposBienController::class,'update']);
            Route::post('eliminatipobien',[TiposBienController::class,'destroy']);
        #TiposClasificacion
            Route::get('obtienetipoclas',[TiposClasificacionController::class,'index']);
            Route::post('guardatipoclas',[TiposClasificacionController::class,'store']);
            Route::post('actualizatipoclas',[TiposClasificacionController::class,'update']);
            Route::post('eliminatipoclas',[TiposClasificacionController::class,'destroy']);
        #TiposDependencias
        Route::get('obtienetipodep',[TiposDependenciasController::class,'index']);
        Route::post('guardatipodep',[TiposDependenciasController::class,'store']);
        Route::post('actualizatipodep',[TiposDependenciasController::class,'update']);
        Route::post('eliminatipodep',[TiposDependenciasController::class,'destroy']);
        #TiposProveedores
        Route::get('obtienetipoprov',[TiposProveedoresController::class,'index']);
        Route::post('guardatipoprov',[TiposProveedoresController::class,'store']);
        Route::post('actualizatipoprov',[TiposProveedoresController::class,'update']);
        Route::post('eliminatipoprov',[TiposProveedoresController::class,'destroy']);
        #TiposProcesos
        Route::get('obtienetipoproc',[TiposProcesosController::class,'index']);
        Route::post('guardatipoproc',[TiposProcesosController::class,'store']);
        Route::post('actualizatipoproc',[TiposProcesosController::class,'update']);
        Route::post('eliminatipoproc',[TiposProcesosController::class,'destroy']);
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

    Route::prefix('muebles')->group(function (){
        #Activos
        Route::get('obtieneactivos',[ActivosController::class,'index']);
        Route::post('guardaactivos',[ActivosController::class,'store']);
        Route::post('actualizaactivos',[ActivosController::class,'update']);
        Route::post('eliminaactivos',[ActivosController::class,'destroy']);
        #Articulos
        Route::get('obtienearticulos',[ArticulosController::class,'index']);
        Route::post('guardaarticulos',[ArticulosController::class,'store']);
        Route::post('actualizaarticulos',[ArticulosController::class,'update']);
        Route::post('eliminaarticulos',[ArticulosController::class,'destroy']);

        #Modelos
        Route::get('obtienemodelos',[ModelosController::class,'index']);
        Route::post('guardamodelos',[ModelosController::class,'store']);
        Route::post('actualizamodelos',[ModelosController::class,'update']);
        Route::post('eliminamodelos',[ModelosController::class,'destroy']);
        #MotivosBaja
        Route::get('obtienemotivosbaja',[MotivosBajaController::class,'index']);
        Route::post('guardamotivosbaja',[MotivosBajaController::class,'store']);
        Route::post('actualizamotivosbaja',[MotivosBajaController::class,'update']);
        Route::post('eliminamotivosbaja',[MotivosBajaController::class,'destroy']);
    
        #Resguardos
        Route::get('obtieneresguardos',[ResguardosController::class,'index']);
        Route::post('guardaresguardos',[ResguardosController::class,'store']);
        Route::post('actualizaresguardos',[ResguardosController::class,'update']);
        Route::post('eliminaresguardos',[ResguardosController::class,'destroy']);
        #ResguardoDet
        Route::get('obtieneresguardodet',[ResguardoDetController::class,'index']);
        Route::post('guardaresguardodet',[ResguardoDetController::class,'store']);
        Route::post('actualizaresguardodet',[ResguardoDetController::class,'update']);
        Route::post('eliminaresguardodet',[ResguardoDetController::class,'destroy']);
        #TiposAdquisicion
        Route::get('obtienetiposadquisicion',[TiposAdquisicionController::class,'index']);
        Route::post('guardatiposadquisicion',[TiposAdquisicionController::class,'store']);
        Route::post('actualizatiposadquisicion',[TiposAdquisicionController::class,'update']);
        Route::post('eliminatiposadquisicion',[TiposAdquisicionController::class,'destroy']);


        #TiposComprobante
        Route::get('obtienetiposcomprobante',[TiposComprobanteController::class,'index']);
        Route::post('guardatiposcomprobante',[TiposComprobanteController::class,'store']);
        Route::post('actualizatiposcomprobante',[TiposComprobanteController::class,'update']);
        Route::post('eliminatiposcomprobante',[TiposComprobanteController::class,'destroy']);
    });



});
