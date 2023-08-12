<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use App\Models\Menus;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menus>
 */
class MenusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     */
    protected $model = Menus::class;

    public function definition()
    {

        return [
            'uuid' => Str::uuid(),
            'Cve' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'Nombre' => $this->faker->sentence(2),
            'Descripcion' => $this->faker->sentence(4),
            'Icono' => $this->faker->word(),
            'Path' => $this->faker->url(),
            'Nivel' => $this->faker->numberBetween(0, 2),
            'Ordenamiento' => $this->faker->numberBetween(0, 99),
            'CreadoPor' => null,
            'ModificadoPor' => Str::uuid(),
            'EliminadoPor' => null,
        ];
    }
}
