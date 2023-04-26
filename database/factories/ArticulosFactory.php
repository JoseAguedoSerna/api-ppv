<?php

namespace Database\Factories;

use App\Models\Articulos;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulos>
 */
class ArticulosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Articulos::class; //hola

    public function definition(): array
    {
        return [
            'uuidTipoComprobante' => '4558ac18-e389-11ed-b5ea-0242ac120002',
            'NoComprobante' =>  $this->faker->unique()->numberBetween(1, 999),
            'uuidProveedor' => '4558a65a-e389-11ed-b5ea-0242ac120002',
            'uuidTiposAdquisicion' => '4558a948-e389-11ed-b5ea-0242ac120002',
            'FechaFactura' => $this->faker->date(),
            'FechaRecepcion' => $this->faker->date(),
            'uuidClasificacion' => '4558aaec-e389-11ed-b5ea-0242ac120002',
            'QR' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'CodigoInterno' => $this->faker->unique()->numberBetween(1, 999),
            'Descripcion' => $this->faker->sentence(3),
            'NoSerie' => $this->faker->regexify('[A-Z0-9]{5}'),
            'uuidMarca' => '4558a01a-e389-11ed-b5ea-0242ac120002',
            'uuidModelos' => '4558a470-e389-11ed-b5ea-0242ac120002',
            'Activo' => $this->faker->boolean(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
