<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detalles_Productos;
use App\Models\Comentario;
use Illuminate\Support\Facades\Storage;

class DetallesProductoController extends Controller
{
    public function mostrarComentarios($id)
    {
        // Cargar los detalles del producto con sus comentarios
        $detallesProducto = Detalles_Productos::with('comentarios')->findOrFail($id);
        
        // Luego, cargarías la vista de comentarios y pasarías los detalles del producto a la vista
        return view('mostrarComentarios', compact('detallesProducto'));
    }
    
    public function agregar(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'contenido' => 'required|string',
        ]);

        // Encontrar el detalle del producto asociado al ID
        $detalleProducto = Detalles_Productos::findOrFail($id);

        // Crear un nuevo comentario
        $comentario = new Comentario();
        $comentario->contenido = $request->contenido;

        // Guardar el comentario asociado al detalle del producto
        $detalleProducto->comentarios()->save($comentario);

        // Redirigir a la página de comentarios o a donde desees
        return redirect()->back()->with('success', 'Comentario agregado correctamente.');
    }
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

    public function catalogo()
    {
        // Obtener todos los detalles de los productos almacenados en la base de datos
        $detallesProductos = Detalles_Productos::all();

        // Pasar los detalles de los productos a la vista para mostrarlos
        return view('catalogo', compact('detallesProductos'));
    }

    public function catalogoNotUser()
    {
        // Obtener todos los detalles de los productos almacenados en la base de datos
        $detallesProductos = Detalles_Productos::all();

        // Pasar los detalles de los productos a la vista para mostrarlos
        return view('catalogoNotUser', compact('detallesProductos'));
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
        ],
        [
            // Mensajes de error personalizados
            'nombre.required' => 'El campo nombre es obligatorio.',
            'precio.required' => 'El campo precio es obligatorio.',
            'precio.numeric' => 'El campo precio debe ser un número.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'caracteristicas.required' => 'El campo características es obligatorio.',
            'colores.required' => 'Debe seleccionar al menos un color.',
            'imagenes.required' => 'Debe seleccionar al menos una imagen.',
            'tiempo_entrega.required' => 'El campo tiempo de entrega es obligatorio.',
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

    public function detallesCatalogo($id)
    {
        // Obtener los detalles del producto con el ID proporcionado
        $producto = Detalles_Productos::findOrFail($id);

        // Pasar los detalles del producto a la vista
        return view('detallesCatalogo', compact('producto'));
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
        ],
        [
            // Mensajes de error personalizados
            'nombre.required' => 'El campo nombre es obligatorio.',
            'precio.required' => 'El campo precio es obligatorio.',
            'precio.numeric' => 'El campo precio debe ser un número.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'caracteristicas.required' => 'El campo características es obligatorio.',
            'colores.required' => 'Debe seleccionar al menos un color.',
            'imagenes.required' => 'Debe seleccionar al menos una imagen.',
            'tiempo_entrega.required' => 'El campo tiempo de entrega es obligatorio.',
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
    
        // Lógica para eliminar suave (soft delete)
        $detalleProducto->delete();
    }    
}
