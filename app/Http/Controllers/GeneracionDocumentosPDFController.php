<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AltasMuebles;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneracionDocumentosPDFController extends Controller
{
    //
    public function pdfaltamobiliario(Request $request)
    {
        // Aquí vamos a recuperar los datos de todas las tablas
        // Folio, Fecha , Hoja
        // Secretaría
        // Subsecretaría
        // Dirección
        // Departamento
        // Número de factura
        // Provvedor
        // Fecha
        /*
        foreach($request->uuidAltaBienMueble as $item){
            $factura = AltasMuebles::find($item);
            if (!$factura) {
                return abort(404, 'La factura no existe.');
            }
        }*/

        //$data = ['factura' => $factura];
        $data = ['factura' => 'bar'];

        $pdf = PDF::loadView('template', $data);

        return $pdf->download('FormatoFRDP001.pdf');
    }
}