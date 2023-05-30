<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtSeguridad;

use App\Http\Controllers\{
    #catalogos
    DependenciasController,
    EmpleadosController,
    EntidadesFederativasController,
    MarcasController,
    MenusController,
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
    TiposReportesController,
    TiposProcesosController,
    TiposUsuariosController,
    TiposTransaccionesController,
    TransaccionesController,
    UsuariosController,
    ModelosController,

    MotivosBajaController,
    TiposAdquisicionController,
    TiposComprobantesController,

    #Muebles
    ActivosController,
    ArticulosController,
    
    ResguardoDetController,
    ResguardosController,

};
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
        Route::post('wheremenus',[MenusController::class,'show']);
        Route::post('guardamenus',[MenusController::class,'store']);
        Route::post('actualizamenus',[MenusController::class,'update']);
        Route::post('eliminamenus',[MenusController::class,'destroy']);
        #Dependencias
        Route::get('obtienedependencias',[DependenciasController::class,'index']);
        Route::post('wheredependencias',[DependenciasController::class,'show']);
        Route::post('guardadependencias',[DependenciasController::class,'store']);
        Route::post('actualizadependencias',[DependenciasController::class,'update']);
        Route::post('eliminadependencias',[DependenciasController::class,'destroy']);
        #Empleados
        Route::get('obtieneempleados',[EmpleadosController::class,'index']);
        Route::post('whereempleados',[EmpleadosController::class,'show']);
        Route::post('guardaempleados',[EmpleadosController::class,'store']);
        Route::post('actualizaempleados',[EmpleadosController::class,'update']);
        Route::post('eliminaempleados',[EmpleadosController::class,'destroy']);
        #EntFederativas
        Route::get('obtieneentfederativas',[EntidadesFederativasController::class,'index']);
        Route::post('whereentfederativas',[EntidadesFederativasController::class,'show']);
        Route::post('guardaentfederativas',[EntidadesFederativasController::class,'store']);
        Route::post('actualizaentfederativas',[EntidadesFederativasController::class,'update']);
        Route::post('eliminaentfederativas',[EntidadesFederativasController::class,'destroy']);
        #Marcas
        Route::get('obtienemarcas',[MarcasController::class,'index']);
        Route::post('wheremarcas',[MarcasController::class,'show']);
        Route::post('guardamarcas',[MarcasController::class,'store']);
        Route::post('actualizamarcas',[MarcasController::class,'update']);
        Route::post('eliminamarcas',[MarcasController::class,'destroy']);
        #Municipios
        Route::get('obtienemunicipios',[MunicipiosController::class,'index']);
        Route::post('wheremunicipios',[MunicipiosController::class,'show']);
        Route::post('guardamunicipios',[MunicipiosController::class,'store']);
        Route::post('actualizamunicipios',[MunicipiosController::class,'update']);
        Route::post('eliminamunicipios',[MunicipiosController::class,'destroy']);
        #NivelReportes
        Route::get('obtienenivelreportes',[NivelReportesController::class,'index']);
        Route::post('wherenivelreportes',[NivelReportesController::class,'show']);
        Route::post('guardanivelreportes',[NivelReportesController::class,'store']);
        Route::post('actualizanivelreportes',[NivelReportesController::class,'update']);
        Route::post('eliminanivelreportes',[NivelReportesController::class,'destroy']);
        #Notificaciones
        Route::get('obtienenotificaciones',[NotificacionesController::class,'index']);
        Route::get('wherenotificaciones',[NotificacionesController::class,'show']);
        Route::post('guardanotificaciones',[NotificacionesController::class,'store']);
        Route::post('actualizanotificaciones',[NotificacionesController::class,'update']);
        Route::post('eliminanotificaciones',[NotificacionesController::class,'destroy']);
        #Perfiles
        Route::get('obtieneperfiles',[PerfilesController::class,'index']);
        Route::post('whereperfiles',[PerfilesController::class,'show']);
        Route::post('guardaperfiles',[PerfilesController::class,'store']);
        Route::post('actualizaperfiles',[PerfilesController::class,'update']);
        Route::post('eliminaperfiles',[PerfilesController::class,'destroy']);
        #Permisos
        Route::get('obtienepermisos',[PermisosController::class,'index']);
        Route::post('wherepermisos',[PermisosController::class,'show']);
        Route::post('guardapermisos',[PermisosController::class,'store']);
        Route::post('actualizapermisos',[PermisosController::class,'update']);
        Route::post('eliminapermisos',[PermisosController::class,'destroy']);
        #PresentacionesMuebles
        Route::get('obtienepresentacionesmuebles',[PresentacionesMueblesController::class,'index']);
        Route::post('wherepresentacionesmuebles',[PresentacionesMueblesController::class,'show']);
        Route::post('guardapresentacionesmuebles',[PresentacionesMueblesController::class,'store']);
        Route::post('actualizapresentacionesmuebles',[PresentacionesMueblesController::class,'update']);
        Route::post('eliminapresentacionesmuebles',[PresentacionesMueblesController::class,'destroy']);
        #Procesos
        Route::get('obtieneprocesos',[ProcesosController::class,'index']);
        Route::post('whereprocesos',[ProcesosController::class,'show']);
        Route::post('guardaprocesos',[ProcesosController::class,'store']);
        Route::post('actualizaprocesos',[ProcesosController::class,'update']);
        Route::post('eliminaprocesos',[ProcesosController::class,'destroy']);
        #Proveedores
        Route::get('obtieneproveedores',[ProveedoresController::class,'index']);
        Route::post('whereproveedores',[ProveedoresController::class,'show']);
        Route::post('guardaproveedores',[ProveedoresController::class,'store']);
        Route::post('actualizaproveedores',[ProveedoresController::class,'update']);
        Route::post('eliminaproveedores',[ProveedoresController::class,'destroy']);
        #Puestos
        Route::get('obtienepuestos',[PuestosController::class,'index']);
        Route::post('wherepuestos',[PuestosController::class,'show']);
        Route::post('guardapuestos',[PuestosController::class,'store']);
        Route::post('actualizapuestos',[PuestosController::class,'update']);
        Route::post('eliminapuestos',[PuestosController::class,'destroy']);
        #Reportes
        Route::get('obtienereportes',[ReportesController::class,'index']);
        Route::post('wherereportes',[ReportesController::class,'show']);
        Route::post('guardareportes',[ReportesController::class,'store']);
        Route::post('actualizareportes',[ReportesController::class,'update']);
        Route::post('eliminareportes',[ReportesController::class,'destroy']);
        #Roles
        Route::get('obtieneroles',[RolesController::class,'index']);
        Route::post('whereroles',[RolesController::class,'show']);
        Route::post('guardaroles',[RolesController::class,'store']);
        Route::post('actualizaroles',[RolesController::class,'update']);
        Route::post('eliminaroles',[RolesController::class,'destroy']);
        #TiposBien
        Route::get('obtienetiposbien',[TiposBienController::class,'index']);
        Route::post('wheretiposbien',[TiposBienController::class,'show']);
        Route::post('guardatiposbien',[TiposBienController::class,'store']);
        Route::post('actualizatiposbien',[TiposBienController::class,'update']);
        Route::post('eliminatiposbien',[TiposBienController::class,'destroy']);
        #TiposClasificacion
        Route::get('obtienetiposclasificacion',[TiposClasificacionController::class,'index']);
        Route::post('wheretiposclasificacion',[TiposClasificacionController::class,'show']);
        Route::post('guardatiposclasificacion',[TiposClasificacionController::class,'store']);
        Route::post('actualizatiposclasificacion',[TiposClasificacionController::class,'update']);
        Route::post('eliminatiposclasificacion',[TiposClasificacionController::class,'destroy']);
        #TiposDependencias
        Route::get('obtienetiposdependencias',[TiposDependenciasController::class,'index']);
        Route::post('wheretiposdependencias',[TiposDependenciasController::class,'show']);
        Route::post('guardatiposdependencias',[TiposDependenciasController::class,'store']);
        Route::post('actualizatiposdependencias',[TiposDependenciasController::class,'update']);
        Route::post('eliminatiposdependencias',[TiposDependenciasController::class,'destroy']);
        #TiposProveedores
        Route::get('obtienetiposproveedores',[TiposProveedoresController::class,'index']);
        Route::post('wheretiposproveedores',[TiposProveedoresController::class,'show']);
        Route::post('guardatiposproveedores',[TiposProveedoresController::class,'store']);
        Route::post('actualizatiposproveedores',[TiposProveedoresController::class,'update']);
        Route::post('eliminatiposproveedores',[TiposProveedoresController::class,'destroy']);
        #TiposProcesos
        Route::get('obtienetiposprocesos',[TiposProcesosController::class,'index']);
        Route::post('wheretiposprocesos',[TiposProcesosController::class,'show']);
        Route::post('guardatiposprocesos',[TiposProcesosController::class,'store']);
        Route::post('actualizatiposprocesos',[TiposProcesosController::class,'update']);
        Route::post('eliminatiposprocesos',[TiposProcesosController::class,'destroy']);
        #TiposReportes
        Route::get('obtienetiposreportes',[TiposReportesController::class,'index']);
        Route::post('wheretiposreportes',[TiposReportesController::class,'show']);
        Route::post('guardatiposreportes',[TiposReportesController::class,'store']);
        Route::post('actualizatiposreportes',[TiposReportesController::class,'update']);
        Route::post('eliminatiposreportes',[TiposReportesController::class,'destroy']);
        #TiposUsuarios
        Route::get('obtienetiposusuarios',[TiposUsuariosController::class,'index']);
        Route::post('wheretiposusuarios',[TiposUsuariosController::class,'show']);
        Route::post('guardatiposusuarios',[TiposUsuariosController::class,'store']);
        Route::post('actualizatiposusuarios',[TiposUsuariosController::class,'update']);
        Route::post('eliminatiposusuarios',[TiposUsuariosController::class,'destroy']);
        #TiposTransacciones
        Route::get('obtienetipostransacciones',[TiposTransaccionesController::class,'index']);
        Route::post('wheretipostransacciones',[TiposTransaccionesController::class,'show']);
        Route::post('guardatipostransacciones',[TiposTransaccionesController::class,'store']);
        Route::post('actualizatipostransacciones',[TiposTransaccionesController::class,'update']);
        Route::post('eliminatipostransacciones',[TiposTransaccionesController::class,'destroy']);
        #Transacciones
        Route::get('obtienetransacciones',[TransaccionesController::class,'index']);
        Route::post('wheretransacciones',[TransaccionesController::class,'show']);
        Route::post('guardatransacciones',[TransaccionesController::class,'store']);
        Route::post('actualizatransacciones',[TransaccionesController::class,'update']);
        Route::post('eliminatransacciones',[TransaccionesController::class,'destroy']);
        #Usuarios
        Route::get('obtieneusuarios',[UsuariosController::class,'index']);
        Route::post('whereusuarios',[UsuariosController::class,'show']);
        Route::post('guardausuarios',[UsuariosController::class,'store']);
        Route::post('actualizausuarios',[UsuariosController::class,'update']);
        Route::post('eliminausuarios',[UsuariosController::class,'destroy']);
        #Modelos
        Route::get('obtienemodelos',[ModelosController::class,'index']);
        Route::post('wheremodelos',[ModelosController::class,'show']);
        Route::post('guardamodelos',[ModelosController::class,'store']);
        Route::post('actualizamodelos',[ModelosController::class,'update']);
        Route::post('eliminamodelos',[ModelosController::class,'destroy']);

        #MotivosBaja
        Route::get('obtienemotivosbaja',[MotivosBajaController::class,'index']);
        Route::post('wheremotivosbaja',[MotivosBajaController::class,'show']);
        Route::post('guardamotivosbaja',[MotivosBajaController::class,'store']);
        Route::post('actualizamotivosbaja',[MotivosBajaController::class,'update']);
        Route::post('eliminamotivosbaja',[MotivosBajaController::class,'destroy']);
        #TiposAdquisicion
        Route::get('obtienetiposadquisicion',[TiposAdquisicionController::class,'index']);
        Route::post('wheretiposadquisicion',[TiposAdquisicionController::class,'show']);
        Route::post('guardatiposadquisicion',[TiposAdquisicionController::class,'store']);
        Route::post('actualizatiposadquisicion',[TiposAdquisicionController::class,'update']);
        Route::post('eliminatiposadquisicion',[TiposAdquisicionController::class,'destroy']);
        #TiposComprobantes
        Route::get('obtienetiposcomprobantes',[TiposComprobantesController::class,'index']);
        Route::post('wheretiposcomprobantes',[TiposComprobantesController::class,'show']);
        Route::post('guardatiposcomprobantes',[TiposComprobantesController::class,'store']);
        Route::post('actualizatiposcomprobantes',[TiposComprobantesController::class,'update']);
        Route::post('eliminatiposcomprobantes',[TiposComprobantesController::class,'destroy']);
    });

    Route::prefix('muebles')->group(function (){
        #Activos
        Route::get('obtieneactivos',[ActivosController::class,'index']);
        Route::post('whereactivos',[ActivosController::class,'show']);
        Route::post('guardaactivos',[ActivosController::class,'store']);
        Route::post('actualizaactivos',[ActivosController::class,'update']);
        Route::post('eliminaactivos',[ActivosController::class,'destroy']);
        #Articulos
        Route::get('obtienearticulos',[ArticulosController::class,'index']);
        Route::post('wherearticulos',[ArticulosController::class,'show']);
        Route::post('guardaarticulos',[ArticulosController::class,'store']);
        Route::post('actualizaarticulos',[ArticulosController::class,'update']);
        Route::post('eliminaarticulos',[ArticulosController::class,'destroy']);

        #Modelos
        Route::get('obtienemodelos',[ModelosController::class,'index']);
        Route::post('wheremodelos',[ModelosController::class,'show']);
        Route::post('guardamodelos',[ModelosController::class,'store']);
        Route::post('actualizamodelos',[ModelosController::class,'update']);
        Route::post('eliminamodelos',[ModelosController::class,'destroy']);
        #MotivosBaja
        Route::get('obtienemotivosbaja',[MotivosBajaController::class,'index']);
        Route::post('wheremotivosbaja',[MotivosBajaController::class,'show']);
        Route::post('guardamotivosbaja',[MotivosBajaController::class,'store']);
        Route::post('actualizamotivosbaja',[MotivosBajaController::class,'update']);
        Route::post('eliminamotivosbaja',[MotivosBajaController::class,'destroy']);
    
        #Resguardos
        Route::get('obtieneresguardos',[ResguardosController::class,'index']);
        Route::post('whereresguardos',[ResguardosController::class,'show']);
        Route::post('guardaresguardos',[ResguardosController::class,'store']);
        Route::post('actualizaresguardos',[ResguardosController::class,'update']);
        Route::post('eliminaresguardos',[ResguardosController::class,'destroy']);
        #ResguardoDet
        Route::get('obtieneresguardodet',[ResguardoDetController::class,'index']);
        Route::post('whereresguardodet',[ResguardoDetController::class,'show']);
        Route::post('guardaresguardodet',[ResguardoDetController::class,'store']);
        Route::post('actualizaresguardodet',[ResguardoDetController::class,'update']);
        Route::post('eliminaresguardodet',[ResguardoDetController::class,'destroy']);
        #TiposAdquisicion
        Route::get('obtienetiposadquisicion',[TiposAdquisicionController::class,'index']);
        Route::post('wheretiposadquisicion',[TiposAdquisicionController::class,'show']);
        Route::post('guardatiposadquisicion',[TiposAdquisicionController::class,'store']);
        Route::post('actualizatiposadquisicion',[TiposAdquisicionController::class,'update']);
        Route::post('eliminatiposadquisicion',[TiposAdquisicionController::class,'destroy']);

        #TiposComprobante
        Route::get('obtienetiposcomprobante',[TiposComprobanteController::class,'index']);
        Route::post('wheretiposcomprobante',[TiposComprobanteController::class,'show']);
        Route::post('guardatiposcomprobante',[TiposComprobanteController::class,'store']);
        Route::post('actualizatiposcomprobante',[TiposComprobanteController::class,'update']);
        Route::post('eliminatiposcomprobante',[TiposComprobanteController::class,'destroy']);
    });



