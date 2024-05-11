<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Detalles_Productos;
use App\Models\User;

class DetallesProductoControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        // Autenticar al usuario
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function it_can_show_all_detalles_productos()
    {
        Detalles_Productos::factory()->count(3)->create();

        $response = $this->get(route('detallesproductos.index'));

        $response->assertViewIs('mostrarTodosDetallesProductos')
                 ->assertStatus(200)
                 ->assertViewHas('detallesProductos');  // Verificar que se pasan los detalles de los productos a la vista
    }

    /** @test */
    public function it_can_show_a_detalle_producto()
    {
        $detalleProducto = Detalles_Productos::factory()->create();

        $response = $this->get(route('detallesproductos.show', $detalleProducto->id));

        $response->assertViewIs('mostrarDetallesProducto')
                 ->assertStatus(200)
                 ->assertViewHas('detalleProducto', $detalleProducto);  // Verificar que se pasa el detalle del producto a la vista
    }

    /** @test */
    public function it_can_create_a_detalle_producto()
    {
        Storage::fake('local');

        $data = [
            'nombre' => 'Producto de prueba',
            'precio' => 100,
            'descripcion' => 'Descripción del producto de prueba',
            'caracteristicas' => 'Características del producto de prueba',
            'colores' => ['rojo', 'azul'],
            'imagenes' => [
                UploadedFile::fake()->image('image1.jpg'),
                UploadedFile::fake()->image('image2.jpg')
            ],
            'tiempo_entrega' => '1 semana'
        ];

        $response = $this->post(route('detallesproductos.store'), $data);

        $this->assertDatabaseHas('detalles_productos', [
            'nombre' => 'Producto de prueba',
            // ... (otros campos)
        ]);

        $this->assertTrue(Storage::disk('local')->exists('imagenes/image1.jpg'));  // Verificar que las imágenes se han almacenado correctamente
        $this->assertTrue(Storage::disk('local')->exists('imagenes/image2.jpg'));

        $response->assertRedirect(route('detallesproductos.index'));
    }

    // Puedes agregar más pruebas para los otros métodos del controlador, como update y destroy.

}
