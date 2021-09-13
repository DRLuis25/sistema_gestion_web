<?php

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
        //Perspectivas proceso 2
        Perspective::create([
            'process_id' => '2',
            'perspective_company_id' => '1',
            'orden' => '1'
        ]);
        Perspective::create([
            'process_id' => '2',
            'perspective_company_id' => '2',
            'orden' => '2'
        ]);
        Perspective::create([
            'process_id' => '2',
            'perspective_company_id' => '3',
            'orden' => '3'
        ]);
        Perspective::create([
            'process_id' => '2',
            'perspective_company_id' => '4',
            'orden' => '4'
        ]);
    }
}
