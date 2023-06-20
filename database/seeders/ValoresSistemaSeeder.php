<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ValoresSistema;
use Illuminate\Support\Str;

class ValoresSistemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!ValoresSistema::where('Cve', 'TIMERMSG')->exists()) {
            ValoresSistema::create([
                'uuid' => Str::uuid()->toString(),
                'Cve' => 'TIMERMSG',
                'Descripcion' => 'Timer para revisar si hay nuevos mensajes',
                'Tipo' => 1,
                'ParamStr' => null,
                'ParamInt' => 60000,
                'CreadoPor' => '',
                'ModificadoPor' => null,
                'EliminadoPor' => null,
            ]);
        }

        if (!ValoresSistema::where('Cve', 'TIMERMSG2')->exists()) {
            ValoresSistema::create([
                'uuid' => Str::uuid()->toString(),
                'Cve' => 'TIMERMSG2',
                'Descripcion' => 'Timer para revisar si hay nuevos mensajes',
                'Tipo' => 1,
                'ParamStr' => null,
                'ParamInt' => 90000,
                'CreadoPor' => '',
                'ModificadoPor' => null,
                'EliminadoPor' => null,
            ]);
        }

        if (!ValoresSistema::where('Cve', 'TIMERMSG3')->exists()) {
            ValoresSistema::create([
                'uuid' => Str::uuid()->toString(),
                'Cve' => 'TIMERMSG3',
                'Descripcion' => 'Timer para revisar si hay nuevos mensajes',
                'Tipo' => 2,
                'ParamStr' => 'Sistema',
                'ParamInt' => null,
                'CreadoPor' => '',
                'ModificadoPor' => null,
                'EliminadoPor' => null,
            ]);
        }        



    }
}
