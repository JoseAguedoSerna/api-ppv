<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignacionResguardo;
use App\Models\AltasMuebles;
use Illuminate\Support\Str;

class AsignacionResguardoController extends Controller
{

        // Buscar los registros de las altas y validar que tengan asignado un resguardante
        // de ser asi hay que inidicar cuales son para desabilitarlos en el Front.


    public function index(Request $request)
    {
        $altaMuebles = AltasMuebles::join('TiposAdquisicion', 'AltasMuebles.uuidTipoAdquisicion', '=', 'TiposAdquisicion.uuid')
            ->join('Areas', 'AltasMuebles.uuidArea', '=', 'Areas.uuid')
            ->join('TipoActivoFijo', 'AltasMuebles.uuidTipoActivoFijo', '=', 'TipoActivoFijo.uuid')
            ->leftjoin('AsignacionResguardos', 'AltasMuebles.uuid', '=', 'AsignacionResguardos.uuidAltaBienMueble')
            ->select('AltasMuebles.*',AltasMuebles::raw("DATE_FORMAT(AltasMuebles.created_at, '%d-%m-%Y') as FechaCreacion"),'TipoActivoFijo.Nombre as TipoActivoFijoNombre','TiposAdquisicion.Nombre AS TipoAdquisicion','Areas.Nombre AS AreaFisica',AltasMuebles::raw('IFNULL(AsignacionResguardos.uuidAltaBienMueble, null) AS uuidAltaBienMueble'))
            ->distinct()->get();
        return $altaMuebles;
    }

    
    // Generar un número de resguardo aleatorio con formato específico
    public function generarNumeroResguardo($longitud)
    {
        // Caracteres válidos para el número de resguardo
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        // Obtener la longitud total de los caracteres válidos
        $longitudCaracteres = strlen($caracteres);
        // Inicializar la variable para almacenar el número de resguardo
        $numeroResguardo = '';
        // Generar el número de resguardo aleatorio
        for ($i = 0; $i < $longitud; $i++) {
            $numeroResguardo .= $caracteres[rand(0, $longitudCaracteres - 1)];
        }
        return $numeroResguardo;
    }


    public function store(Request $request)
    {

        // Obtener el numero de resguardo, llamando a la función generarNumeroResguardo
        // Validar que no exista un numero de resguardo asignado en la tabla
        // Si ya existe volver a llamar a la  función
        // de lo contrario asignar ese valor a la variable
        // Insertar el valor en la tabla de AsignacionResguardo
        $numeroResguardo = $this->generarNumeroResguardo($longitud=11);
        while (AsignacionResguardo::where('NumeroResguardo', $numeroResguardo)->exists()) {
            $numeroResguardo = generarNumeroResguardo($longitud=10);
        }

        try {
            $data = $request->only([
            'uuidEmpleado',
            'uuidDependencia',
            'uuidDepartamento',
            'uuidDependenciaPertenece',
            'uuidEmpleado',
            'Ubicacion',
            ]);
            $data['NumeroResguardo'] = $numeroResguardo;
            foreach($request->uuidAltaBienMueble as $item){
                $data['uuidAltaBienMueble'] = $item;
                $data['uuid'] = Str::uuid(); // Agregar UUID único
                $nuevaAsignacion = AsignacionResguardo::create($data);
                $nuevaAsignacion->save();
            }

        }   catch (\Illuminate\Database\QueryException $ex){
            return response('Error en base de datos: '.$ex->getMessage(), 400)
                ->header('Content-Type', 'text/plain');
        }

        $jsonData = $nuevaAsignacion->toJson();
        return $jsonData;
    }
}
