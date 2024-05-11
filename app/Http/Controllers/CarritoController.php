<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Pedido;

class CarritoController extends Controller
{
    public function agregarAlCarrito(Request $request)
    {
        // Obtener el usuario actualmente autenticado
        $user = auth()->user();

        // Verificar si el producto ya está en el carrito del usuario
        $productoEnCarrito = Carrito::where('user_id', $user->id)
                                    ->where('producto_id', $request->producto_id)
                                    ->first();

        if ($productoEnCarrito) {
            // Si el producto ya está en el carrito, simplemente actualiza la cantidad
            $productoEnCarrito->update([
                'cantidad' => $productoEnCarrito->cantidad + $request->cantidad,
            ]);
        } else {
            // Si el producto no está en el carrito, crea una nueva entrada en el carrito
            Carrito::create([
                'user_id' => $user->id,
                'producto_id' => $request->producto_id,
                'cantidad' => $request->cantidad,
            ]);
        }

        return redirect()->route('catalogo.productos');
    }

    public function verCarrito()
    {
        // Obtener el usuario actualmente autenticado
        $user = auth()->user();

        // Obtener los productos en el carrito del usuario con sus detalles de producto cargados ansiosamente
        $productosEnCarrito = Carrito::where('user_id', $user->id)->with('producto')->get();

        // Calcular el total de la compra
        $total = 0;
        foreach ($productosEnCarrito as $producto) {
            $total += $producto->cantidad * $producto->producto->precio;
        }

        // Retornar vista con los datos necesarios
        return view('carrito-compras', compact('productosEnCarrito', 'total'));
    }


    public function actualizarCarrito(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'id' => 'required|exists:carrito,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Obtener el registro del carrito a actualizar
        $carrito = Carrito::findOrFail($request->carrito_id);

        // Actualizar la cantidad del producto en el carrito
        $carrito->update([
            'cantidad' => $request->cantidad,
        ]);
    }

    public function realizarPedido()
    {
        // Obtener el usuario actualmente autenticado
        $user = auth()->user();

        // Obtener los productos en el carrito del usuario
        $productosEnCarrito = Carrito::where('user_id', $user->id)->with('producto')->get();

        // Crear un nuevo registro de pedido para el usuario
        $pedido = Pedido::create([
            'user_id' => $user->id,
            // Otras columnas de pedido, como dirección de envío, total, etc.
        ]);

        // Asociar los productos del carrito al pedido recién creado
        $pedido->productos()->attach($productosEnCarrito);

        // Limpiar el carrito del usuario
        Carrito::where('user_id', $user->id)->delete();
    }

    public function eliminarDelCarrito($carritoId)
    {
        // Buscar el producto en el carrito por su ID
        $carrito = Carrito::findOrFail($carritoId);

        // Verificar si el usuario autenticado es el propietario del carrito
        if ($carrito->user_id !== auth()->id()) {
            // Si el usuario no es el propietario del carrito, redirigir a algún lugar seguro
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        // Eliminar el producto del carrito
        $carrito->delete();

        return redirect()->back()->with('success', 'El producto se ha eliminado del carrito correctamente.');
    }
}