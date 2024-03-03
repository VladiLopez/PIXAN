<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detalles_Productos;
use Illuminate\Support\Facades\Storage;

class DetallesProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ingresarDetallesProducto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos recibidos del formulario
        $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string',
            'caracteristicas' => 'required|string',
            'colores' => 'required|array',
            'imagenes' => 'required|array', // Modificación para manejar una matriz de imágenes
            'imagenes.*' => 'mimes:jpeg,png,jpg,gif|max:10000', // Validación de cada imagen
            'tiempo_entrega' => 'required|string',
        ]);

        // Convertir los colores a formato JSON para poder solicitar alguno en especifico
        $colores = json_encode($request->input('colores'));

        // Procesar y guardar las imágenes
        $imagenes = [];
        foreach ($request->file('imagenes') as $imagen) {
            $ruta = $imagen->store('/imagenes'); // Guardar la imagen en una carpeta 'imagenes' en el almacenamiento de Laravel
            $imagen->store('/public/imagenes'); // Consultar la imagen en una carpeta 'public/imagenes' en el almacenamiento de Laravel
            $imagenes[] = $ruta; // Guardar la ruta de la imagen para su posterior almacenamiento en la base de datos
        }

        // Convertir el arreglo de rutas de imágenes en una cadena de texto separada por comas
        $imagenesCadena = implode(',', $imagenes);

        // Crear un nuevo objeto DetalleProducto y asignar los valores recibidos
        $detalleProducto = new Detalles_Productos();
        $detalleProducto->nombre = $request->nombre;
        $detalleProducto->precio = $request->precio;
        $detalleProducto->descripcion = $request->descripcion;
        $detalleProducto->caracteristicas = $request->caracteristicas;
        $detalleProducto->colores = $colores; // Guardar los colores en formato JSON
        $detalleProducto->imagenes = $imagenesCadena; // Guardar las rutas de las imágenes como una cadena de texto
        $detalleProducto->tiempo_entrega = $request->tiempo_entrega;

        // Guardar el objeto en la base de datos
        $detalleProducto->save();

        // Redirigir a la página de inicio o a donde quieras después de guardar
        return redirect()->route('detallesproductos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
