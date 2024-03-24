<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inventario;
use Illuminate\Support\Facades\Storage;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Obtener todos los detalles de los productos almacenados en la base de datos
        $detallesInventario = Inventario::all();

        // Pasar los detalles de los productos a la vista para mostrarlos
        return view('mostrarTodosInventario', compact('detallesInventario'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ingresarInventario');
    }

    /**public function store(Request $request)
    {
        // Validación de los datos recibidos del formulario
        $request->validate([
            'nombre' => 'required|string',
            'cantidad' => 'required|integer',
            'clasificacion' => 'required|string',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        ],
        [
            // Mensajes de error personalizados
            'nombre.required' => 'El campo nombre es obligatorio.',
            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.numeric' => 'El campo cantidad debe ser un número.',
            'clasificacion.required' => 'El campo calsificacion es obligatorio.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'imagen.required' => 'Debe seleccionar al menos una imagen.',
        ]);

        // Convertir los colores a formato JSON
        //$colores = json_encode($request->input('colores'));

        // Procesar y guardar las imágenes
        $imagen = [];
        foreach ($request->file('imagen') as $imagen) {
            $ruta = $imagen->store('imagen'); // Guardar la imagen en una carpeta 'imagen' en el almacenamiento de Laravel
            $imagen->storeAs('public/imagen', $imagen->getClientOriginalName()); // Consultar la imagen en una carpeta 'public/imagen' en el almacenamiento de Laravel
            $imagen[] = $ruta; // Guardar la ruta de la imagen para su posterior almacenamiento en la base de datos
        }

        // Convertir el arreglo de rutas de imágenes en una cadena de texto separada por comas
        $imagenesCadena = implode(',', $imagen);

        // Crear un nuevo objeto DetalleInventario y asignar los valores recibidos
        $detalleInventario = new Inventario();
        $detalleInventario->nombre = $request->nombre;
        $detalleInventario->cantidad = $request->cantidad;
        $detalleInventario->clasificacion = $request->clasificacion;
        $detalleInventario->descripcion = $request->descripcion;
        $detalleInventario->imagen = $imagenesCadena; // Guardar las rutas de las imágenes como una cadena de texto

        // Guardar el objeto en la base de datos
        $detalleInventario->save();

        // Redirigir a la página de inicio o a donde quieras después de guardar
        return redirect()->back();
    }*/

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'cantidad' => 'required|numeric',
            'clasificacion' => 'required|string',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:100000',
        ],
        [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.numeric' => 'El campo cantidad debe ser un número.',
            'clasificacion.required' => 'El campo clasificación es obligatorio.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'imagen.image' => 'El archivo debe ser una imagen válida.',
            'imagen.max' => 'La imagen no debe ser mayor de 10 MB.',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $rutaImagen = $imagen->store('imagen');
        }

        $detalleInventario = new Inventario();
        $detalleInventario->nombre = $request->nombre;
        $detalleInventario->cantidad = $request->cantidad;
        $detalleInventario->clasificacion = $request->clasificacion;
        $detalleInventario->descripcion = $request->descripcion;
        $detalleInventario->imagen = $rutaImagen;

        $detalleInventario->save();

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Recuperar el detalle del producto específico de la base de datos
        $detalleInventario = Inventario::findOrFail($id);

        // Pasar los detalles del producto a la vista para mostrarlos
        return view('mostrarDetallesInventario', compact('detalleInventario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // Recuperar el detalle del producto específico de la base de datos
        $detalleInventario = Inventario::findOrFail($id);

        // Pasar los detalles del producto a la vista para editarlos
        return view('editarInventario', compact('detalleInventario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // Validación de los datos recibidos del formulario
        $request->validate([
            'nombre' => 'required|string',
            'cantidad' => 'required|numeric',
            'clasificacion' => 'required|string',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:100000',
        ]);

        // Recuperar el detalle del producto específico de la base de datos
        $detalleInventario = Inventario::findOrFail($id);

        // Actualizar los valores del detalle del producto
        $detalleInventario->nombre = $request->nombre;
        $detalleInventario->cantidad = $request->cantidad;
        $detalleInventario->clasificacion = $request->clasificacion;
        $detalleInventario->descripcion = $request->descripcion;
        
        // Procesar y guardar las imágenes si se proporcionaron
        if ($request->hasFile('imagen')) {
            $imagen = [];
            foreach ($request->file('imagen') as $imagen) {
                $ruta = $imagen->store('/imagen'); // Guardar la imagen en una carpeta 'imagenes' en el almacenamiento de Laravel
                $imagen->store('/public/imagen'); 
                $imagen[] = $ruta; // Guardar la ruta de la imagen para su posterior almacenamiento en la base de datos
            }
            // Convertir el arreglo de rutas de imágenes en una cadena de texto separada por comas
            $imagenesCadena = implode(',', $imagenes);
            $detalleProducto->imagenes = $imagenesCadena; // Guardar las rutas de las imágenes como una cadena de texto
        }

        // Guardar los cambios en la base de datos
        $detalleProducto->save();

        // Redirigir a la página de inicio o a donde quieras después de actualizar
        return redirect()->route('detallesinventarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // Buscar el detalle del producto específico en la base de datos
        $detalleInventario = Iventario::findOrFail($id);

        // Eliminar las imágenes asociadas al producto del almacenamiento de Laravel
        $imagenes = explode(',', $detalleInventario->imagenes);
        foreach ($imagenes as $imagen) {
            // Eliminar la imagen del almacenamiento
            Storage::delete($imagen);
            Storage::delete("public/".$imagen);
        }

        // Eliminar el detalle del producto
        $detalleInventario->delete();
    }
}
