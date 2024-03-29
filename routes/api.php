<?php

namespace App\Http\Controllers;

use App\Models\AltasMuebles;
use App\Models\Documentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtSeguridad;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;


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
    ActivosController,
    EstatusResguardoController,
    DependenciasTiposController,
    MenuPermisoController,
    PerfilRolController,
    RolMenusController,
    UsuarioPerfile,
    AreasController,
    LineasController,
    TipoActivoFijoController,
    TitularController,
    SecretariaController,
    RangosController,
    ProcesoStepsController,
    ProcesoRangoController,

    #Muebles
    ArticulosController,
    ResguardosDetController,
    ResguardosController,
    CitasController,

    #Tickets
    TicketsController,
    TiposTicketsController,
    CategoriasTicketsController,
    PrioridadTicketsController,
    StatusTicketsController,

    #Mensajes
    MensajesController,

    #administracion
    ValoresGlobalesController,
    ValoresSistemaController,
    DepartamentosController
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
        Route::post('wheremenus',[MenusController::class,'show']);
        Route::post('guardamenus',[MenusController::class,'store']);
        Route::post('actualizamenus',[MenusController::class,'update']);
        Route::post('eliminamenus',[MenusController::class,'destroy']);
        Route::post('generamenu',[MenusController::class,'generaMenusUsuario']);
        #Dependencias
        Route::get('obtienedependencias',[DependenciasController::class,'index']);
        Route::post('wheredependencias',[DependenciasController::class,'show']);
        Route::post('guardadependencias',[DependenciasController::class,'store']);
        Route::post('actualizadependencias',[DependenciasController::class,'update']);
        Route::post('eliminadependencias',[DependenciasController::class,'destroy']);
        Route::post('detalledependencias',[DependenciasController::class,'show']);
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
        Route::post('wherenotificaciones',[NotificacionesController::class,'show']);
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
        #Activos
        Route::get('obtieneactivos',[ActivosController::class,'index']);
        Route::post('whereactivos',[ActivosController::class,'show']);
        Route::post('guardaactivos',[ActivosController::class,'store']);
        Route::post('actualizaactivos',[ActivosController::class,'update']);
        Route::post('eliminaactivos',[ActivosController::class,'destroy']);
        #EstatusResguardo
        Route::get('obtieneestatusresguardo',[EstatusResguardoController::class,'index']);
        Route::post('guardaestatusresguardo',[EstatusResguardoController::class,'store']);
        Route::post('actualizaestatusresguardo',[EstatusResguardoController::class,'update']);
        Route::post('eliminaestatusresguardo',[EstatusResguardoController::class,'destroy']);
        Route::post('whereestatusresguardo',[EstatusResguardoController::class,'show']);
        #Titular
        Route::get('obtienetitular',[TitularController::class,'index']);
        Route::post('guardatitular',[TitularController::class,'store']);
        Route::post('actualizatitular',[TitularController::class,'update']);
        Route::post('eliminatitular',[TitularController::class,'destroy']);
        Route::post('detalletitular',[TitularController::class,'show']);
        #Areas
        Route::get('obtienearea',[AreasController::class,'index']);
        Route::post('guardaarea',[AreasController::class,'store']);
        Route::post('actualizaarea',[AreasController::class,'update']);
        Route::post('eliminaarea',[AreasController::class,'destroy']);
        Route::post('detallearea',[AreasController::class,'show']);
        #Linea
        Route::get('obtienelinea',[LineasController::class,'index']);
        Route::post('guardalinea',[LineasController::class,'store']);
        Route::post('actualizalinea',[LineasController::class,'update']);
        Route::post('eliminalinea',[LineasController::class,'destroy']);
        Route::post('detallelinea',[LineasController::class,'show']);
        #TipoActivoFijo
        Route::get('obtienetipoactivofijo',[TipoActivoFijoController::class,'index']);
        Route::post('guardatipoactivofijo',[TipoActivoFijoController::class,'store']);
        Route::post('actualizatipoactivofijo',[TipoActivoFijoController::class,'update']);
        Route::post('eliminatipoactivofijo',[TipoActivoFijoController::class,'destroy']);
        Route::post('detalletipoactivofijo',[TipoActivoFijoController::class,'show']);
        #Secretaria
        Route::get('obtienesecretaria',[SecretariaController::class,'index']);
        Route::post('guardasecretaria',[SecretariaController::class,'store']);
        Route::post('actualizasecretaria',[SecretariaController::class,'update']);
        Route::post('eliminasecretaria',[SecretariaController::class,'destroy']);
        Route::post('detallesecretaria',[SecretariaController::class,'show']);
        #DependenciasTiposController
        Route::get('obtienedependenciastipos',[DependenciasTiposController::class,'index']);
        Route::post('guardadependenciastipos',[DependenciasTiposController::class,'store']);
        Route::post('actualizadependenciastipos',[DependenciasTiposController::class,'update']);
        Route::post('eliminadependenciastipos',[DependenciasTiposController::class,'destroy']);
        #MenuPermisoController
        Route::get('obtienemenupermiso',[MenuPermisoController::class,'index']);
        Route::post('guardamenupermiso',[MenuPermisoController::class,'store']);
        Route::post('actualizamenupermiso',[MenuPermisoController::class,'update']);
        Route::post('eliminamenupermiso',[MenuPermisoController::class,'destroy']);
        Route::post('detallemenupermiso',[MenuPermisoController::class,'show']);
        #PerfilRolController
        Route::get('obtieneperfilrol',[PerfilRolController::class,'index']);
        Route::post('guardaperfilrol',[PerfilRolController::class,'store']);
        Route::post('actualizaperfilrol',[PerfilRolController::class,'update']);
        Route::post('eliminaperfilrol',[PerfilRolController::class,'destroy']);
        #RolMenuController
        Route::get('obtienerolmenu',[RolMenuController::class,'index']);
        Route::post('guardarolmenu',[RolMenuController::class,'store']);
        Route::post('actualizarolmenu',[RolMenuController::class,'update']);
        Route::post('eliminarolmenu',[RolMenuController::class,'destroy']);
        #UsuarioPerfil
        Route::get('obtieneusuarioperfil',[UsuarioPerfilController::class,'index']);
        Route::post('guardausuarioperfil',[UsuarioPerfilController::class,'store']);
        Route::post('actualizausuarioperfil',[UsuarioPerfilController::class,'update']);
        Route::post('eliminausuarioperfil',[UsuarioPerfilController::class,'destroy']);
        #Rangos
        Route::get('obtienerango',[RangosController::class,'index']);
        Route::post('guardarango',[RangosController::class,'store']);
        Route::post('actualizarango',[RangosController::class,'update']);
        Route::post('eliminarango',[RangosController::class,'destroy']);
        Route::post('detallerango',[RangosController::class,'show']);
        #Procesosteps
        Route::get('obtieneprocesosteps',[ProcesoStepsController::class,'index']);
        Route::post('guardaprocesosteps',[ProcesoStepsController::class,'store']);
        Route::post('actualizaprocesosteps',[ProcesoStepsController::class,'update']);
        Route::post('eliminaprocesosteps',[ProcesoStepsController::class,'destroy']);
        Route::post('detalleprocesosteps',[ProcesoStepsController::class,'show']);
        #ProcesoRango
        Route::get('obtieneprocesorango',[ProcesoRangoController::class,'index']);
        Route::post('guardaprocesorango',[ProcesoRangoController::class,'store']);
        Route::post('actualizaprocesorango',[ProcesoRangoController::class,'update']);
        Route::post('eliminaprocesorango',[ProcesoRangoController::class,'destroy']);
        Route::post('detalleprocesorango',[ProcesoRangoController::class,'show']); 
        #Departamentos
        Route::get('obtienedepartamentos',[DepartamentosController::class,'index']);
        Route::post('wheredepartamentos',[DepartamentosController::class,'show']);
        Route::post('guardadepartamentos',[DepartamentosController::class,'store']);
        Route::post('actualizadepartamentos',[DepartamentosController::class,'update']);
        Route::post('eliminadepartamentos',[DepartamentosController::class,'destroy']);

    });
    Route::prefix('muebles')->group(function (){
        #Articulos
        Route::get('obtienearticulos',[ArticulosController::class,'index']);
        Route::post('wherearticulos',[ArticulosController::class,'show']);
        Route::post('guardaarticulos',[ArticulosController::class,'store']);
        Route::post('actualizaarticulos',[ArticulosController::class,'update']);
        Route::post('eliminaarticulos',[ArticulosController::class,'destroy']);

        Route::post('detallearticulo',[ArticulosController::class,'show']);

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
        #Citas
        Route::get('obtienecitas',[CitasController::class,'index']);
        Route::post('wherecitas',[CitasController::class,'show']);
        Route::post('guardacitas',[CitasController::class,'store']);
        Route::post('actualizacitas',[CitasController::class,'update']);
        Route::post('eliminacitas',[CitasController::class,'destroy']);



    });
    Route::prefix('tickets')->group(function (){
        #Tickets
        Route::get('obtienetickets',[TicketsController::class,'index']);
        Route::post('guardatickets',[TicketsController::class,'store']);
        Route::post('actualizatickets',[TicketsController::class,'update']);
        Route::post('eliminatickets',[TicketsController::class,'destroy']);
        Route::post('detalletickets',[TicketsController::class,'show']);
        #TiposTickets
        Route::get('obtienetipostickets',[TiposTicketsController::class,'index']);
        Route::post('guardatipostickets',[TiposTicketsController::class,'store']);
        Route::post('actualizatipostickets',[TiposTicketsController::class,'update']);
        Route::post('eliminatipostickets',[TiposTicketsController::class,'destroy']);
        Route::post('detalletipostickets',[TiposTicketsController::class,'show']);
        #CategoriasTickets
        Route::get('obtienecategoriastickets',[CategoriasTicketsController::class,'index']);
        Route::post('guardacategoriastickets',[CategoriasTicketsController::class,'store']);
        Route::post('actualizacategoriastickets',[CategoriasTicketsController::class,'update']);
        Route::post('eliminacategoriastickets',[CategoriasTicketsController::class,'destroy']);
        Route::post('detallecategoriastickets',[CategoriasTicketsController::class,'show']);
        #PrioridadTickets
        Route::get('obtieneprioridadtickets',[PrioridadTicketsController::class,'index']);
        Route::post('guardaprioridadtickets',[PrioridadTicketsController::class,'store']);
        Route::post('actualizaprioridadtickets',[PrioridadTicketsController::class,'update']);
        Route::post('eliminaprioridadtickets',[PrioridadTicketsController::class,'destroy']);
        Route::post('detalleprioridadtickets',[PrioridadTicketsController::class,'show']);
        #StatusTickets
        Route::get('obtienestatustickets',[StatusTicketsController::class,'index']);
        Route::post('guardastatustickets',[StatusTicketsController::class,'store']);
        Route::post('actualizastatustickets',[StatusTicketsController::class,'update']);
        Route::post('eliminastatustickets',[StatusTicketsController::class,'destroy']);
        Route::post('detallestatustickets',[StatusTicketsController::class,'show']);
    });

    Route::prefix('mensajes')->group(function (){
        #Mensajes
        Route::get('obtienemensajes',[MensajesController::class,'index']);
        Route::post('guardamensajes',[MensajesController::class,'store']);
        Route::post('actualizamensajes',[MensajesController::class,'update']);
        Route::post('eliminamensajes',[MensajesController::class,'destroy']);
        Route::post('detallemensajes',[MensajesController::class,'show']);
        Route::post('mensajeleido',[MensajesController::class,'read']);
        Route::post('mensajesnuevos',[MensajesController::class,'new']);

    });

    Route::prefix('administracion')->group(function (){
        Route::get('obtienevalores',[ValoresGlobalesController::class,'index']);
        Route::post('guardavalores',[ValoresGlobalesController::class,'store']);
        Route::post('actualizavalores',[ValoresGlobalesController::class,'update']);
        Route::post('eliminavalores',[ValoresGlobalesController::class,'destroy']);
        Route::post('detallevalores',[ValoresGlobalesController::class,'show']);

        Route::get('obtienevalsistema',[ValoresSistemaController::class,'index']);
        Route::post('actualizavalsistema',[ValoresSistemaController::class,'update']);
        Route::post('detallevalsistema',[ValoresSistemaController::class,'show']);
    });

    Route::prefix('gastocorriente')->group(function() {
        Route::get('obtienegastocorriente',[AltasMueblesController::class,'index']);
        Route::post('guardagastocorriente',[AltasMueblesController::class, 'store']);
        Route::post('buscadorMuebles',[AltasMueblesController::class, 'search']);
        Route::post('confirmaFactura',[AltasMueblesController::class, 'confirmafactura']);
        //Route::post('uploadfactura',[AltasMueblesController::class, 'uploadfactura']);
        Route::post('descargafactura',[AltasMueblesController::class,'descargaFactura']);
    });

    Route::prefix('rolesmenu')->group(function() {
        Route::get('obtiene',[RolesMenuController::class,'index']);
        Route::post('getbyrol',[RolesMenuController::class,'byrol']);
        Route::post('actualiza',[RolesMenuController::class,'update']);
        Route::post('elimina',[RolesMenuController::class,'delete']);
    });
    Route::prefix('asignacionresguardo')->group(function() {
        Route::post('guardaresguardo',[AsignacionResguardoController::class, 'store']);
        Route::get('listadomueblespararesguardo',[AsignacionResguardoController::class, 'index']);
    });
    Route::prefix('generaciondocumentos')->group(function() {
        Route::post('generarPDFAlta',[GeneracionDocumentosPDFController::class, 'store']);
    });

 });
