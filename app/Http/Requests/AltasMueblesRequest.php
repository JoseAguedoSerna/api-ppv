<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AltasMueblesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $errorMessages = [];

        foreach ($errors->messages() as $field => $messages) {
            $errorMessages[] = $messages[0];
        }

        $errorMessage = implode(' ', $errorMessages);

        throw new HttpResponseException(response()->json([
            'msg' => $errorMessage
        ], 400));
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'ArchivoFactura' => 'required|file',
            'uuidTipoBien' => 'required|uuid',
            'uuidLinea' => 'required|uuid',
            //'uuidPersonalResguardo' => 'required|uuid',
            //'uuidMarca' => 'required|uuid',
            //'uuidModelo' => 'required|uuid',
            'uuidArea' => 'required|uuid',
            //'uuidConductor' => 'required|uuid',
            'uuidTipoActivoFijo' => 'required|uuid',
            'uuidTipoAdquisicion' => 'required|uuid',
            //'NoInventario' => 'required|integer|unique_field:App\Models\AltasMuebles',
            'NoActivo' => 'required|unique_field:App\Models\AltasMuebles',
            'Cantidad' => 'required|integer',
            //'Descripcion' => 'required|string|max:256',
            'CostoSinIva' => 'required|numeric',
            'CostoConIva' => 'required|numeric',
            'DepreciacionAcumulada' => 'required|numeric',
            'FechaEntrada' => 'required|date',
            'FechaUltimaActualizacion' => 'required|date',
            //'Placas' => 'required|string|max:256',
            //'Series' => 'required|string|max:256',
            //'Anio' => 'required|numeric',
            'VidaUtil' => 'required|numeric',
            //'CvePersonal' => 'required|string|max:256',
            //'CveLinea' => 'required|string|max:256',
            //'DescripcionLinea' => 'required|string|max:256',
            'CodigoContable' => 'required|integer',
            'FechaDeUso' => 'required|date',
            'ClaveInterior' => 'required|integer',
            //'DescripcionDetalle' => 'required|string|max:256',
            'DescripcionTipoActivoFijo' => 'required|string|max:256',
            'uuidProveedor' => 'required|string|max:256',
        ];
    }
}
