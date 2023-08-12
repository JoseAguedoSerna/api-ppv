<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuarios;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuarios>
 */
class UsuariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Usuarios::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'uuidTiCentral' => Str::uuid(),
            'uuidDependencia' => '86da6118-d7ae-11ed-afa1-0242ac120002',
            'NombreCorto' => $this->faker->unique()->lexify('?????'),
            'Puesto' => $this->faker->jobTitle(),
            'CreadoPor' => null,
            'ModificadoPor' => null,
            'EliminadoPor' => null,
        ];
    }
}
