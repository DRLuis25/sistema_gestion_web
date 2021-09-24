<?php

use App\Models\matrizPriorizado;
use App\Models\Perspective;
use App\Models\perspectiveCompany;
use Illuminate\Database\Seeder;

class MapaEstrategicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Perspectivas para toda la empresa
        $perspectiva1 = perspectiveCompany::create([
            'company_id' => '1',
            'descripcion' => 'Financiera',
            //'orden' => '1'
        ]);
        $perspectiva2 = perspectiveCompany::create([
            'company_id' => '1',
            'descripcion' => 'Clientes',
            //'orden' => '2'
        ]);
        $perspectiva3 = perspectiveCompany::create([
            'company_id' => '1',
            'descripcion' => 'Procesos Internos',
            //'orden' => '3'
        ]);
        $perspectiva4 = perspectiveCompany::create([
            'company_id' => '1',
            'descripcion' => 'Aprendizaje y crecimiento',
            //'orden' => '4'
        ]);
        //Matriz priorizado
        $matrizPriorizado = matrizPriorizado::create([
            'process_map_id'=>'1',
            'process_criterio_id'=>'1',
            'description'=> '2021-1',
            'process_id_data'=> '["6","2","3","9","5"]',
            'process_id_data_flow_diagram'=> '["6","2","3","9","5"]',
            'process_id_data_seguimiento'=> '["6","2","3","9","5"]',
            'process_id_data_all'=> '["6","2","3","9","5"]',
            'process_values_data'=> '["57","45","43","43","41"]',
        ]);
        //Perspectivas proceso 2
        Perspective::create([
            'matriz_priorizado_id' => '1',
            'process_id' => '2',
            'perspective_company_id' => '1',
            'orden' => '1'
        ]);
        Perspective::create([
            'matriz_priorizado_id' => '1',
            'process_id' => '2',
            'perspective_company_id' => '2',
            'orden' => '2'
        ]);
        Perspective::create([
            'matriz_priorizado_id' => '1',
            'process_id' => '2',
            'perspective_company_id' => '3',
            'orden' => '3'
        ]);
        Perspective::create([
            'matriz_priorizado_id' => '1',
            'process_id' => '2',
            'perspective_company_id' => '4',
            'orden' => '4'
        ]);
    }
}
