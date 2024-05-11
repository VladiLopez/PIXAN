<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Detalles_Productos::factory(5)->create();
        /*$data = [
            [
                'nombre' => 'Florero 1',
                'precio' => 654,
                'descripcion' => 'Muy bonito producto para decorar tu casa',	
                'caracteristicas' => 'Alto: 30cm - Ancho: 24cm - Material: Flexo', 		
                'colores' => '["#51E033","#E10600","#E1C401","#FFFFFF","#000000","#000BE0","#808080"]', 
                'imagenes' => 'imagenes/98wZC668PLOgCG0u8TXnCAnRVCEwq0i10nCHj1fa.png',
                'tiempo_entrega' => '3 a 4 dias'
            ],
            [
                'nombre' => 'Florero 2',
                'precio' => 654,
                'descripcion' => 'Muy bonito producto para decorar tu casa',	
                'caracteristicas' => 'Alto: 40cm - Ancho: 34cm - Material: Flexo', 		
                'colores' => '["#51E033","#E10600","#E1C401","#FFFFFF","#000000","#000BE0","#808080"]', 
                'imagenes' => 'imagenes/98wZC668PLOgCG0u8TXnCAnRVCEwq0i10nCHj1fa.png',
                'tiempo_entrega' => '3 a 4 dias'
            ],
        ];
        DB::table('detallesProductos')->insert($data);*/
    }
}
