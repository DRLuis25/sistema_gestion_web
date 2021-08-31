<?php

use App\Models\Perspective;
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
        $perspectiva1 = Perspective::create([
            'process_id' => '2',
            'descripcion' => 'Financiera',
            'orden' => '1'
        ]);
        $perspectiva2 = Perspective::create([
            'process_id' => '2',
            'descripcion' => 'Clientes',
            'orden' => '2'
        ]);
        $perspectiva3 = Perspective::create([
            'process_id' => '2',
            'descripcion' => 'Procesos Internos',
            'orden' => '3'
        ]);
        $perspectiva4 = Perspective::create([
            'process_id' => '2',
            'descripcion' => 'Aprendizaje y crecimiento',
            'orden' => '4'
        ]);
    }
}
