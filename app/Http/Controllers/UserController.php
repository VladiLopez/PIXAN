<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function mostrarUsuarios()
    {
        $usuarios = User::all();
        return view('usuarios', ['usuarios' => $usuarios]);
    }

    public function mostrarUsuarioEsp($id)
    {
        $usuario = User::findOrFail($id);
        return view('ViewUsuario', ['usuario' => $usuario]);
    }

    public function editarUsuario($id)
    {
        $usuario = User::findOrFail($id);
        return view('editUsuario', ['usuario' => $usuario]);
    }

    public function actualizarUsuario(Request $request, $id)
    {
        // Procesar y guardar las imágenes
        $imagenes = [];
        foreach ($request->file('imagenes') as $imagen) {
            $ruta = $imagen->store('/imagenes'); // Guardar la imagen en una carpeta 'imagenes' en el almacenamiento de Laravel
            $imagen->store('/public/imagenes'); // Consultar la imagen en una carpeta 'public/imagenes' en el almacenamiento de Laravel
            $imagenes[] = $ruta; // Guardar la ruta de la imagen para su posterior almacenamiento en la base de datos
        }

        // Convertir el arreglo de rutas de imágenes en una cadena de texto separada por comas
        $imagenesCadena = implode(',', $imagenes);

        $usuario = User::findOrFail($id);
        $usuario->name = $request->input('nombre');
        $usuario->email = $request->input('email');
        $usuario->is_admin = $request->input('is_admin');
        $usuario->imagenes = $imagenesCadena;

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente');
    }
}
