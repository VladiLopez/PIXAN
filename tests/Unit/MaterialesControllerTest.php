<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\StockMateriales;
use App\Models\User;

class MaterialesControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_returns_200_and_expected_text_for_index_route()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->get('/stockmateriales');
        $response->assertStatus(200);
        $response->assertSee('Mostrar Detalles de Materiales');
    }


    /** @test */
    public function it_creates_record_in_database_and_redirects_on_post_request()
    {
        $user = User::factory()->create();
        $this->actingAs($user); 

        $data = [
            'nombre' => 'Material de prueba',
            'caracteristicas' => 'Características de prueba',
            'marca' => 'Marca de prueba',
            'colores' => ['rojo', 'verde'],
            'imagen' => [UploadedFile::fake()->image('imagen.jpg')]
        ];

        $response = $this->post('/stockmateriales', $data);

        $response->assertRedirect('/stockmateriales');

        $this->assertDatabaseHas('stockmateriales', [
            'nombre' => 'Material de prueba',
            'caracteristicas' => 'Características de prueba',
            'marca' => 'Marca de prueba',
            'colores' => json_encode(['rojo', 'verde']), // Convirtiendo a JSON
            // Asegura que otros campos estén presentes según la migración
        ]);
    }

    /** @test */
    public function it_validates_post_request_with_incorrect_or_missing_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user); 

        $data = []; // Proporciona datos incorrectos o faltantes aquí

        $response = $this->post('/stockmateriales', $data);

        $response->assertSessionHasErrors([
            // Agrega aquí los campos que esperas que fallen en la validación
        ]);
    }

    /** @test */
    public function it_deletes_record_from_database_and_redirects_on_delete_request()
    {
        $user = User::factory()->create();
        $this->actingAs($user); 
        
        $material = StockMateriales::factory()->create();

        $response = $this->delete('/stockmateriales/'.$material->id);

        $response->assertRedirect('/stockmateriales');

        $this->assertDatabaseMissing('stockmateriales', ['id' => $material->id]);
    }
}
