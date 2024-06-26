<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function MiPerfil()
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Verificar si el usuario está autenticado
        if (!$usuario) {
            // Si el usuario no está autenticado, redirigirlo a la página de inicio de sesión con un mensaje de error
            return redirect()->route('login')->with('error', 'Inicia sesión para ver tu perfil.');
        }

        // Si el usuario está autenticado, mostrar su perfil
        return view('MyProfile', ['usuario' => $usuario]);
    }

    public function editarUsuario($id)
    {
        $usuario = User::findOrFail($id);
        return view('editUsuario', ['usuario' => $usuario]);
    }

    public function actualizarUsuario(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        if ($request->hasFile('profile_photo_path')) {
            // Procesar y guardar las imágenes
            $profile_photo_path = [];
            foreach ($request->file('profile_photo_path') as $imagen) {
                $ruta = $imagen->store('/profile_photo'); // Guardar la imagen en una carpeta 'imagenes' en el almacenamiento de Laravel
                $imagen->store('/public/profile_photo'); // Consultar la imagen en una carpeta 'public/imagenes' en el almacenamiento de Laravel
                $profile_photo_path[] = $ruta; // Guardar la ruta de la imagen para su posterior almacenamiento en la base de datos
            }
            // Convertir el arreglo de rutas de imágenes en una cadena de texto separada por comas
            $imagenesCadena = implode(',', $profile_photo_path);
            $usuario->profile_photo_path = $imagenesCadena;
        }

        $usuario->name = $request->input('nombre');
        $usuario->email = $request->input('email');
        $usuario->is_admin = $request->input('is_admin');
        

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el detalle del producto específico en la base de datos
        $usuario = User::findOrFail($id);
    
        // Lógica para eliminar suave (soft delete)
        $usuario->delete();
    }    
}
