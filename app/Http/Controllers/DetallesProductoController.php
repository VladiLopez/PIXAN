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
        // Obtener todos los detalles de los productos almacenados en la base de datos
        $detallesProductos = Detalles_Productos::all();

        // Pasar los detalles de los productos a la vista para mostrarlos
        return view('mostrarTodosDetallesProductos', compact('detallesProductos'));
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

        // Convertir los colores a formato JSON
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
        // Recuperar el detalle del producto específico de la base de datos
        $detalleProducto = Detalles_Productos::findOrFail($id);

        // Pasar los detalles del producto a la vista para mostrarlos
        return view('mostrarDetallesProducto', compact('detalleProducto'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Recuperar el detalle del producto específico de la base de datos
        $detalleProducto = Detalles_Productos::findOrFail($id);

        // Pasar los detalles del producto a la vista para editarlos
        return view('editarDetallesProducto', compact('detalleProducto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los datos recibidos del formulario
        $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string',
            'caracteristicas' => 'required|string',
            'colores' => 'required|array',
            'imagenes' => 'nullable|array', // Modificación para permitir imágenes opcionales
            'imagenes.*' => 'nullable|mimes:jpeg,png,jpg,gif|max:10000', // Validación de cada imagen
            'tiempo_entrega' => 'required|string',
        ]);

        // Recuperar el detalle del producto específico de la base de datos
        $detalleProducto = Detalles_Productos::findOrFail($id);

        // Actualizar los valores del detalle del producto
        $detalleProducto->nombre = $request->nombre;
        $detalleProducto->precio = $request->precio;
        $detalleProducto->descripcion = $request->descripcion;
        $detalleProducto->caracteristicas = $request->caracteristicas;
        $detalleProducto->colores = json_encode($request->input('colores')); // Guardar los colores en formato JSON
        $detalleProducto->tiempo_entrega = $request->tiempo_entrega;

        // Procesar y guardar las imágenes si se proporcionaron
        if ($request->hasFile('imagenes')) {
            $imagenes = [];
            foreach ($request->file('imagenes') as $imagen) {
                $ruta = $imagen->store('/imagenes'); // Guardar la imagen en una carpeta 'imagenes' en el almacenamiento de Laravel
                $imagen->store('/public/imagenes'); 
                $imagenes[] = $ruta; // Guardar la ruta de la imagen para su posterior almacenamiento en la base de datos
            }
            // Convertir el arreglo de rutas de imágenes en una cadena de texto separada por comas
            $imagenesCadena = implode(',', $imagenes);
            $detalleProducto->imagenes = $imagenesCadena; // Guardar las rutas de las imágenes como una cadena de texto
        }

        // Guardar los cambios en la base de datos
        $detalleProducto->save();

        // Redirigir a la página de inicio o a donde quieras después de actualizar
        return redirect()->route('detallesproductos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el detalle del producto específico en la base de datos
        $detalleProducto = Detalles_Productos::findOrFail($id);

        // Eliminar las imágenes asociadas al producto del almacenamiento de Laravel
        $imagenes = explode(',', $detalleProducto->imagenes);
        foreach ($imagenes as $imagen) {
            // Eliminar la imagen del almacenamiento
            Storage::delete($imagen);
            Storage::delete("public/".$imagen);
        }

        // Eliminar el detalle del producto
        $detalleProducto->delete();

        // Redirigir a la página de inicio o a donde desees después de eliminar el producto
        return redirect()->route('detallesproductos.index');
    }
}
