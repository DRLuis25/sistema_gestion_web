<?php

use App\Models\businessUnit;
use App\Models\Criterio;
use App\Models\Process;
use App\Models\processCriterio;
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
            'name' => 'Unidad de Negocio Principal',
            'description' => 'Unidad de negocio primaria'
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
            'unidad' => 'minutos',
            'parent_process_id' => null,
            'status' => false,
        ]);
        processType::create([
            'process_id' =>  $process1->id,
            'type_id' => '1',
        ]);
        $process2 = Process::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Asesoría y venta al cliente',
            'description' => ' ',
            'unidad' => 'minutos',
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
            'unidad' => 'minutos',
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
            'unidad' => 'minutos',
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
            'unidad' => 'minutos',
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
            'unidad' => 'minutos',
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
            'unidad' => 'minutos',
            'parent_process_id' => null,
            'status' => false,
        ]);
        processType::create([
            'process_id' =>  $process7->id,
            'type_id' => '3',
        ]);
        $process8 = Process::create([
            'process_map_id' => $processMap1->id,
            'name' => 'Soporte Tecnológico',
            'description' => ' ',
            'unidad' => 'minutos',
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
            'unidad' => 'minutos',
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
        //LLENAR MATRIZ PRIORIZACIÓN
        $matriz = processCriterio::create([
            'process_map_id' => $processMap1->id,
            'data' => '{"proceso_id-1-criterio_id-1":"2","proceso_id-1-criterio_id-2":"3","proceso_id-1-criterio_id-3":"4","proceso_id-1-criterio_id-4":"2","proceso_id-2-criterio_id-1":"5","proceso_id-2-criterio_id-2":"1","proceso_id-2-criterio_id-3":"3","proceso_id-2-criterio_id-4":"4","proceso_id-3-criterio_id-1":"2","proceso_id-3-criterio_id-2":"4","proceso_id-3-criterio_id-3":"4","proceso_id-3-criterio_id-4":"1","proceso_id-4-criterio_id-1":"1","proceso_id-4-criterio_id-2":"4","proceso_id-4-criterio_id-3":"4","proceso_id-4-criterio_id-4":"3","proceso_id-5-criterio_id-1":"3","proceso_id-5-criterio_id-2":"5","proceso_id-5-criterio_id-3":"1","proceso_id-5-criterio_id-4":"2","proceso_id-6-criterio_id-1":"4","proceso_id-6-criterio_id-2":"5","proceso_id-6-criterio_id-3":"3","proceso_id-6-criterio_id-4":"5","proceso_id-7-criterio_id-1":"1","proceso_id-7-criterio_id-2":"1","proceso_id-7-criterio_id-3":"5","proceso_id-7-criterio_id-4":"3","proceso_id-8-criterio_id-1":"2","proceso_id-8-criterio_id-2":"1","proceso_id-8-criterio_id-3":"5","proceso_id-8-criterio_id-4":"2","proceso_id-9-criterio_id-1":"1","proceso_id-9-criterio_id-2":"4","proceso_id-9-criterio_id-3":"5","proceso_id-9-criterio_id-4":"2"}',
            'process_id_data' => '["6","2","3","9","5","4","1","8","7"]',
            'process_values_data' => '["57","45","43","43","41","40","40","36","32"]'
        ]);

    }
}
