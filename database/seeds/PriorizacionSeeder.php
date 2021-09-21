<?php

use App\Models\Frequency;
use Illuminate\Database\Seeder;

class PriorizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Frequency::create([
            'descripcion' => 'Diaria'
        ]);
        Frequency::create([
            'descripcion' => 'Semanal'
        ]);
        Frequency::create([
            'descripcion' => 'Mensual'
        ]);
        Frequency::create([
            'descripcion' => 'Anual'
        ]);
    }
}
