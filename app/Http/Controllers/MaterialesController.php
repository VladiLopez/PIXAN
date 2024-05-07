<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\StockMateriales;

use Illuminate\Support\Facades\Storage;

class MaterialesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Obtener todos los detalles de los productos almacenados en la base de datos
        $stockMateriales = StockMateriales::all();

        // Pasar los detalles de los productos a la vista para mostrarlos
        return view('mostrarTodosDetallesMateriales', compact('stockMateriales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ingresarDetallesMateriales');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos recibidos del formulario
        $request->validate([
            'nombre' => 'required|string',
            'caracteristicas' => 'required|string',
            'marca' => 'required|string',
            'colores' => 'required|array',
            'imagen' => 'required|array', // Modificación para manejar una matriz de imágenes
            'imagen.*' => 'mimes:jpeg,png,jpg,gif|max:10000', // Validación de cada imagen
        ],
        [
            // Mensajes de error personalizados
            'nombre.required' => 'El campo nombre es obligatorio.',
            'caracteristicas.required' => 'El campo características es obligatorio.',
            'marca.required' => 'El campo características es obligatorio.',
            'colores.required' => 'Debe seleccionar al menos un color.',
            'imagen.required' => 'Debe seleccionar al menos una imagen.',
        ]);

        // Convertir los colores a formato JSON
        $colores = json_encode($request->input('colores'));

        // Procesar y guardar las imágenes
        $imagen = [];
        foreach ($request->file('imagen') as $images) {
            $ruta = $images->store('/imagenes'); // Guardar la imagen en una carpeta 'imagenes' en el almacenamiento de Laravel
            $images->store('/public/imagenes'); // Consultar la imagen en una carpeta 'public/imagenes' en el almacenamiento de Laravel
            $imagen[] = $ruta; // Guardar la ruta de la imagen para su posterior almacenamiento en la base de datos
        }

        // Convertir el arreglo de rutas de imágenes en una cadena de texto separada por comas
        $imagenCadena = implode(',', $imagen);

        // Crear un nuevo objeto StockMateriales y asignar los valores recibidos
        $stockMaterial = new StockMateriales();
        $stockMaterial->nombre = $request->nombre;
        $stockMaterial->caracteristicas = $request->caracteristicas;
        $stockMaterial->marca = $request->marca;
        $stockMaterial->colores = $colores; // Guardar los colores en formato JSON
        $stockMaterial->imagen = $imagenCadena; // Guardar las rutas de las imágenes como una cadena de texto

        // Guardar el objeto en la base de datos
        $stockMaterial->save();

        // Redirigir a la página de inicio o a donde quieras después de guardar
        return redirect()->route('stockmateriales.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Recuperar el detalle del producto específico de la base de datos
        $stockMateriales = StockMateriales::findOrFail($id);

        // Pasar los detalles del producto a la vista para mostrarlos
        return view('mostrarDetallesMaterial', compact('stockMateriales'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Recuperar el detalle del producto específico de la base de datos
        $stockMateriales = StockMateriales::findOrFail($id);

        // Pasar los detalles del producto a la vista para mostrarlos
        return view('editarDetallesMaterial', compact('stockMateriales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los datos recibidos del formulario
        $request->validate([
            'nombre' => 'required|string',
            'caracteristicas' => 'required|string',
            'marca' => 'required|string',
            'colores' => 'required|array',
            'imagenes' => 'nullable|array', // Modificación para permitir imágenes opcionales
            'imagenes.*' => 'nullable|mimes:jpeg,png,jpg,gif|max:10000', // Validación de cada imagen
        ],
        [
            // Mensajes de error personalizados
            'nombre.required' => 'El campo nombre es obligatorio.',
            'caracteristicas.required' => 'El campo características es obligatorio.',
            'marca.required' => 'El campo características es obligatorio.',
            'colores.required' => 'Debe seleccionar al menos un color.',
            'imagen.required' => 'Debe seleccionar al menos una imagen.',
        ]);

        // Recuperar el detalle del producto específico de la base de datos
        $stockMaterial = StockMateriales::findOrFail($id);

        $stockMaterial->nombre = $request->nombre;
        $stockMaterial->caracteristicas = $request->caracteristicas;
        $stockMaterial->marca = $request->marca;
        $stockMaterial->colores = json_encode($request->input('colores')); // Guardar los colores en formato JSON

        // Procesar y guardar las imágenes si se proporcionaron
        if ($request->hasFile('imagen')) {
            $imagen = [];
            foreach ($request->file('imagen') as $image) {
                $ruta = $image->store('/imagenes'); // Guardar la imagen en una carpeta 'imagenes' en el almacenamiento de Laravel
                $image->store('/public/imagenes'); 
                $imagen[] = $ruta; // Guardar la ruta de la imagen para su posterior almacenamiento en la base de datos
            }
            // Convertir el arreglo de rutas de imágenes en una cadena de texto separada por comas
            $imagenesCadena = implode(',', $imagen);
            $stockMaterial->imagen = $imagenesCadena; // Guardar las rutas de las imágenes como una cadena de texto
        }


        // Guardar el objeto en la base de datos
        $stockMaterial->save();

        // Redirigir a la página de inicio o a donde quieras después de guardar
        return redirect()->route('stockmateriales.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el detalle del producto específico en la base de datos
        $stockMaterial = StockMateriales::findOrFail($id);

        // Eliminar las imágenes asociadas al producto del almacenamiento de Laravel
        $imagen = explode(',', $stockMaterial->imagenes);
        foreach ($imagen as $image) {
            // Eliminar la imagen del almacenamiento
            Storage::delete($image);
            Storage::delete("public/".$image);
        }

        // Eliminar el detalle del producto
        $stockMaterial->delete();
    }
}
