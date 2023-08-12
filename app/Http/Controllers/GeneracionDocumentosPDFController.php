<?php
namespace App\Http\Controllers;

use App\Http\Requests\reportesPDFRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneracionDocumentosPDFController extends Controller
{
    //
    public function store(reportesPDFRequest $request)
    {
       $data = json_decode($request->data);
     
       //return $data->Nombre;
       //return $data;
       /*
       foreach($request->data as $item){
        $data[] = $item;
        }
        */


        
            // Validar si los siguientes campos se van a tomar del sistema PAUA
            // Secretaría
            // Subsecretaría
        

            // Número de factura, se esta agregando al formulario de alta
            // Folio
            // Proveedor, hay que dar de alta desde la migración
            // Fecha de la factura , está fecha no se a que fecha se refiere ????
        

            // Hay dos campos de descripción (Validar cual se queda)


        // No hay opción para poder ingresar las lineas de los muebles separados que componen una factura.
        // Hay que crear una tabla relacionada AltaMuebles con las lineas que pertenecen a esa alta
            // Campos de la tabla relacionada:
            // Numero de inventario
            // Marca
            // Modelo
            // Serie
            // Valor factura
            // Deescripcion
            // Condiciones

        // Hay que generar una funcion para el folio, de el formato de las altes y partir de un número especificado
                // por el area de bienes muebles, y que este sea autoincrementable, validar qe esos folios no se repitan con el historico
                
        // Validar que el numero de activo no se repita
        // Validar que el número de inventario no se repita (Validar con el equipo)

            // Ya esta solo falta integrarlo
            // Nombre del resguardante : responsanble 
            // Titular del area, Se obtiene de la tabla de Empleados / Ok
            // Enlace de movilidad, agregar en el form y consultar el catalogo de Empleados /
            // Fecha , está fecha a que se fecha se refiere ?
            // Hoja, se debe de generar en automatico calculando el numero de registros que se van a crear



   




    return $this->generaPDF($data);
    

    }

    public function generaPDF($data)
    {
        view()->share('template', $data);
        $pdf = Pdf::setPaper('letter','landscape')->loadView('template');
        
        return $pdf->download('solicitud'.'.pdf');
    }


}