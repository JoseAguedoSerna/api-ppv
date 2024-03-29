<?php

namespace App\Services;

use App\Models\Documentos;
use Illuminate\Database\Eloquent\Factories\Factory;
use GuzzleHttp\Exception\RequestException; // Importa la clase RequestException de Guzzle
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\AltasMuebles;

class DocumentosStorageService
{
    public function guardaDocumento(\Illuminate\Http\UploadedFile $factura,$nombre, $ruta, $modelType, $modelId)
    {
        $prexi = Carbon::now()->format('YmdHis');
        $nombre = $prexi.$factura->getClientOriginalName();

        $model = app()->make($modelType)->where('uuid', $modelId)->first();

        $document = new Documentos([
            'Nombre' => $nombre,
            'RutaFolder' => $ruta,
        ]);

        $model->documentos()->save($document);
        if (!$factura instanceof \Illuminate\Http\UploadedFile) {
            // Manejar el error o lanzar una excepción si es necesario
            return "archivo invalido";
        }

        $this->apiFTP($factura, $nombre, $ruta);
    }

    public function apiFTP(\Illuminate\Http\UploadedFile $Factura, $Nombre, $Ruta)
    {
        $prexi = Carbon::now()->format('YmdHis');


        // Ruta del API al que enviarás el archivo
        $apiURL = env('API_DOCUMENTOS').'/SaveFile';


        // Inicializar el cliente Guzzle
        $client = new \GuzzleHttp\Client();

        try {
            // Realizar la solicitud al API con el archivo adjunto en formato Multipart
            $response = $client->post($apiURL, [
                'multipart' => [
                    [
                        'name' => 'FILE',
                        'contents' => fopen($Factura->getPathname(), 'r'),
                        'filename' => $Nombre,
                    ],
                     //Puedes agregar más campos Multipart si es necesario
                     [
                         'name' => 'ROUTE',
                         'contents' => $Ruta,
                     ],
                ],
            ]);

            // Obtener la respuesta del API
            $responseData = $response->getBody()->getContents();
            // Procesar la respuesta del API si es necesario
            // ...

            return response()->json(['message' => 'Archivo enviado correctamente al API'], 200);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Manejar el error en caso de que el API devuelva un código de estado no válido
            // $e->getCode() contiene el código de estado HTTP devuelto por el API
            // $e->getMessage() contiene el mensaje de error devuelto por el API
            return response()->json(['error' => 'Error en la solicitud al API'], 500);
        } catch (\Exception $e) {
            // Manejar otros errores que puedan ocurrir durante la llamada al API
            // $e->getMessage() contiene el mensaje de error
            return response()->json(['error' => 'Error en la solicitud al API'], 500);
        }
    }

    public function descargaDocumento($modelType, $IdModel)
    {
        $mueble = app()->make($modelType)->where('uuid', $IdModel)->first();

        // Obtener el documento relacionado con el mueble
        $documento = $mueble->documentos()->first();

        $apiURL = env('API_DOCUMENTOS').'/GetByName';

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $apiURL, [
            'form_params' => [
                'ruta' => $documento->RutaFolder,
                'nombre' => $documento->Nombre,
            ],
        ]);

        // Devolver la respuesta del API como respuesta de la solicitud actual
        return $response;
    }


}
