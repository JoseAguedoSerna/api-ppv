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
    PresentacionMueblesController,
    ProcesosController,
    ProveedoresController,
    PuestosController,
    ReportesController,
    RolesController,
    TipoBienController,
    TipoClasificacionController,
    TipoDependenciasController,
    TipoProveedoresController,
    TipoProcesosController,
    TiposReportesController,
    TiposUsuariosController,
    TipoTransaccionesController,
    TransaccionesController,
    UsuariosController,
    #Muebles
    ActivosController,
    ArticulosController,
    MarcasMueblesController,
    ModelosController,
    MotivosBajaController,
    PresentacionesMueblesController,
    ResguardosController,
    ResguardoDetController,
    TiposAdquisicionController,
    TiposBienController,
    TiposClasificacionController,
    TiposComprobanteController
};
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// post manda datos
// get obtener datos
// update envia actualiza datos
// delete envia actualiza estatus
// TODOS los catalogos

Route::prefix('iniciosesion')->group(function () {
    Route::post('menususuario',[MenusController::class,'generaMenusUsuario']);
});

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
        #MarcasMuebles
        Route::get('obtienemarcasmuebles',[MarcasMueblesController::class,'index']);
        Route::post('guardamarcasmuebles',[MarcasMueblesController::class,'store']);
        Route::post('actualizamarcasmuebles',[MarcasMueblesController::class,'update']);
        Route::post('eliminamarcasmuebles',[MarcasMueblesController::class,'destroy']);
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
        #PresentacionesMuebles
        Route::get('obtienepresentacionesmuebles',[PresentacionesMueblesController::class,'index']);
        Route::post('guardapresentacionesmuebles',[PresentacionesMueblesController::class,'store']);
        Route::post('actualizapresentacionesmuebles',[PresentacionesMueblesController::class,'update']);
        Route::post('eliminapresentacionesmuebles',[PresentacionesMueblesController::class,'destroy']);
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
        #TiposBien
        Route::get('obtienetiposbien',[TiposBienController::class,'index']);
        Route::post('guardatiposbien',[TiposBienController::class,'store']);
        Route::post('actualizatiposbien',[TiposBienController::class,'update']);
        Route::post('eliminatiposbien',[TiposBienController::class,'destroy']);
        #TiposClasificacion
        Route::get('obtienetiposclasificacion',[TiposClasificacionController::class,'index']);
        Route::post('guardatiposclasificacion',[TiposClasificacionController::class,'store']);
        Route::post('actualizatiposclasificacion',[TiposClasificacionController::class,'update']);
        Route::post('eliminatiposclasificacion',[TiposClasificacionController::class,'destroy']);
        #TiposComprobante
        Route::get('obtienetiposcomprobante',[TiposComprobanteController::class,'index']);
        Route::post('guardatiposcomprobante',[TiposComprobanteController::class,'store']);
        Route::post('actualizatiposcomprobante',[TiposComprobanteController::class,'update']);
        Route::post('eliminatiposcomprobante',[TiposComprobanteController::class,'destroy']);
    });



});
