<?php

use App\Models\businessUnit;
use App\Models\Criterio;
use App\Models\Process;
use App\Models\processMap;
use App\Models\processType;
use App\Models\Rol;
use App\Models\Type;
use Illuminate\Database\Seeder;

class MapaProcesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type1 = Type::create([
            'description' => 'Proceso Estratégico'
        ]);
        $type2 = Type::create([
            'description' => 'Proceso Primario'
        ]);
        $type3 = Type::create([
            'description' => 'Proceso de Apoyo'
        ]);
        $bUnit1 = businessUnit::create([
            'company_id' => '1',
            'name' => 'Unidad de Negocio 1',
            'description' => 'Descripción UN1'
        ]);
        $processMap1 = processMap::create([
            'company_id' => '1',
            'business_unit_id' => $bUnit1->id,
            'period' => '2021-1',
            'launch' => '1-1-2021',
            'created_at' => '28-7-2021',
            'updated_at' => '28-7-2021',
        ]);
        //$suppliers = factory(Process::class,10)->create();
        $process1 = Process::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Gestión Dirección',
            'description' => ' ',
            'parent_process_id' => null,
            'status' => false,
        ]);
        processType::create([
            'process_id' =>  $process1->id,
            'type_id' => '1',
        ]);
        $process2 = Process::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Gestión Financiera',
            'description' => ' ',
            'parent_process_id' => null,
            'status' => false,
        ]);
        processType::create([
            'process_id' =>  $process2->id,
            'type_id' => '1',
        ]);
        $process3 = Process::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Gestión Legal',
            'description' => ' ',
            'parent_process_id' => null,
            'status' => false,
        ]);
        processType::create([
            'process_id' =>  $process3->id,
            'type_id' => '1',
        ]);
        $process4 = Process::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Gestión Compras',
            'description' => ' ',
            'parent_process_id' => null,
            'status' => false,
        ]);
        processType::create([
            'process_id' =>  $process4->id,
            'type_id' => '2',
        ]);
        $process5 = Process::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Gestión Ventas',
            'description' => ' ',
            'parent_process_id' => null,
            'status' => false,
        ]);
        processType::create([
            'process_id' =>  $process5->id,
            'type_id' => '2',
        ]);
        $process6 = Process::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Gestión Marketing',
            'description' => ' ',
            'parent_process_id' => null,
            'status' => false,
        ]);
        processType::create([
            'process_id' =>  $process6->id,
            'type_id' => '2',
        ]);
        $process7 = Process::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Gestión de Personal',
            'description' => ' ',
            'parent_process_id' => null,
            'status' => false,
        ]);
        processType::create([
            'process_id' =>  $process7->id,
            'type_id' => '3',
        ]);
        $process8 = Process::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Soporte Tecnológicos',
            'description' => ' ',
            'parent_process_id' => null,
            'status' => false,
        ]);
        processType::create([
            'process_id' =>  $process8->id,
            'type_id' => '3',
        ]);
        $process9 = Process::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Atención de Reclamos',
            'description' => ' ',
            'parent_process_id' => null,
            'status' => false,
        ]);
        processType::create([
            'process_id' =>  $process9->id,
            'type_id' => '3',
        ]);
        Criterio::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Contribución al objetivo Estratégico',
            'peso' => '5',
            'description' => ''
        ]);
        Criterio::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Impacto en el negocio',
            'peso' => '4',
            'description' => ''
        ]);
        Criterio::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Impacto en el cliente',
            'peso' => '4',
            'description' => ''
        ]);
        Criterio::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Éxito a corto plazo',
            'peso' => '1',
            'description' => ''
        ]);
        Rol::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Cliente'
        ]);
        Rol::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Encargado de Recepción'
        ]);
        Rol::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Personal de Piso'
        ]);
    }
}
