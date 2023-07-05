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
                'Tipo' => 2,
                'ParamStr' => null,
                'ParamInt' => 3600000,
                'CreadoPor' => '',
                'ModificadoPor' => null,
                'EliminadoPor' => null,
            ]);
        }

        if (!ValoresSistema::where('Cve', 'COLORPRI')->exists()) {
            ValoresSistema::create([
                'uuid' => Str::uuid()->toString(),
                'Cve' => 'COLORPRI',
                'Descripcion' => 'Color en formato hexadecimal para el color primario de la plataforma',
                'Tipo' => 1,
                'ParamStr' => '15212f',
                'ParamInt' => null,
                'CreadoPor' => '',
                'ModificadoPor' => null,
                'EliminadoPor' => null,
            ]);
        }

        if (!ValoresSistema::where('Cve', 'COLORSEC')->exists()) {
            ValoresSistema::create([
                'uuid' => Str::uuid()->toString(),
                'Cve' => 'COLORSEC',
                'Descripcion' => 'Color en formato hexadecimal para el color secundario de la plataforma',
                'Tipo' => 1,
                'ParamStr' => 'bda889',
                'ParamInt' => null,
                'CreadoPor' => '',
                'ModificadoPor' => null,
                'EliminadoPor' => null,
            ]);
        }

        if (!ValoresSistema::where('Cve', 'CORREOSALIDA')->exists()) {
            ValoresSistema::create([
                'uuid' => Str::uuid()->toString(),
                'Cve' => 'CORREOSALIDA',
                'Descripcion' => 'Corre electronico que se utilizara para enviar correo desde la plataforma',
                'Tipo' => 1,
                'ParamStr' => 'pabmi@patrimonio.com',
                'ParamInt' => null,
                'CreadoPor' => '',
                'ModificadoPor' => null,
                'EliminadoPor' => null,
            ]);
        }

        if (!ValoresSistema::where('Cve', 'SHOWMSG')->exists()) {
            ValoresSistema::create([
                'uuid' => Str::uuid()->toString(),
                'Cve' => 'SHOWMSG',
                'Descripcion' => 'Tiempo que se muestra el mensaje de (Grabado Exitoso, Actualizacion Exitosa, Eliminado Exitosamente) milisegundos',
                'Tipo' => 2,
                'ParamStr' => null,
                'ParamInt' => 4000,
                'CreadoPor' => '',
                'ModificadoPor' => null,
                'EliminadoPor' => null,
            ]);
        }

        if (!ValoresSistema::where('Cve', 'PAGINACION')->exists()) {
            ValoresSistema::create([
                'uuid' => Str::uuid()->toString(),
                'Cve' => 'PAGINACION',
                'Descripcion' => 'Número de registros para paginación',
                'Tipo' => 2,
                'ParamStr' => null,
                'ParamInt' => 100,
                'CreadoPor' => '',
                'ModificadoPor' => null,
                'EliminadoPor' => null,
            ]);
        }

        if (!ValoresSistema::where('Cve', 'PATHFACTURA')->exists()) {
            ValoresSistema::create([
                'uuid' => Str::uuid()->toString(),
                'Cve' => 'PATHFACTURA',
                'Descripcion' => 'Ruta o FTP donde se almacenarian las facturas importados',
                'Tipo' => 1,
                'ParamStr' => '',
                'ParamInt' => null,
                'CreadoPor' => '',
                'ModificadoPor' => null,
                'EliminadoPor' => null,
            ]);
        }   
        
        if (!ValoresSistema::where('Cve', 'PATHDOCUMENTOS')->exists()) {
            ValoresSistema::create([
                'uuid' => Str::uuid()->toString(),
                'Cve' => 'PATHDOCUMENTOS',
                'Descripcion' => 'Ruta o FTP donde se almacenarian los documentos importados',
                'Tipo' => 1,
                'ParamStr' => '',
                'ParamInt' => null,
                'CreadoPor' => '',
                'ModificadoPor' => null,
                'EliminadoPor' => null,
            ]);
        }           

    }
}
