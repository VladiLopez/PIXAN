<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\StockMateriales::factory(5)->create();
        /*$data = [
            [
                'nombre' => 'Filamento Verde',	
                'caracteristicas' => 'Alto: 10cm - Ancho: 20cm', 	
                'marca' => 'Motorola',	
                'colores' => '["#51E033"]', 
                'imagen' => 'imagenes/WzN9Isfzc7B9quoxBdFFSWlLlBWCG8uvv3wD5Z9S.jpg',
            ],
            [
                'nombre' => 'Filamento Rojo',	
                'caracteristicas' => 'Alto: 10cm - Ancho: 20cm', 	
                'marca' => 'Motorola',	
                'colores' => '["#E10600"]', 
                'imagen' => 'imagenes/ObCLRJKGbngDCvZesPiKlSeEfttM3lILwRKFnK7Z.jpg',
            ],
        ];
        DB::table('stockMateriales')->insert($data);*/
    }
}
