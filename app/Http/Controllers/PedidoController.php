<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoProducto;
use Illuminate\Support\Facades\Mail;
use App\Mail\CorreoMailable;

class PedidoController extends Controller
{
    public function realizarPedido(Request $request)
    {
        // Lógica para crear un nuevo pedido
        $pedido = new Pedido();
        $pedido->user_id = auth()->id(); // Asigna el ID del usuario autenticado
        $pedido->fecha = now(); // Asigna la fecha actual
        $pedido->save();


        // Lógica para guardar los productos del carrito en la tabla pedido_producto
        foreach (auth()->user()->productosEnCarrito as $producto) {
            $pedidoProducto = new PedidoProducto();
            $pedidoProducto->pedido_id = $pedido->id;
            $pedidoProducto->producto_id = $producto->id;
            $pedidoProducto->cantidad = $producto->pivot->cantidad;
            // Asegúrate de ajustar esto según tu modelo Detalles_Productos
            $pedidoProducto->precio_unitario = $producto->precio;
            $pedidoProducto->save();
        }

        // Lógica para vaciar el carrito después de realizar el pedido
        auth()->user()->productosEnCarrito()->detach();

        // Redirigir a una página de confirmación de pedido o a donde desees
        return redirect()->route('confirmacion.pedido');
    }       

    public function confirmacionPedido()
    {
        $user = auth()->user();
        
        // Obtener el último pedido realizado
        $ultimoPedido = Pedido::latest()->first();

        // Obtener los productos del último pedido con la relación de Producto cargada
        $productosPedido = PedidoProducto::where('pedido_id', $ultimoPedido->id)->with('producto')->get();

        // Calcular el total de la compra
        $totalCompra = $productosPedido->sum(function ($producto) {
            return $producto->cantidad * $producto->precio_unitario;
        });

        // Enviar correo electrónico al usuario
        Mail::to($user->email)->send(new CorreoMailable);

        // Renderizar la vista de confirmación del pedido con los datos obtenidos
        return view('detalles-pedido', compact('ultimoPedido', 'productosPedido', 'totalCompra'));
    }

    public function listarPedidos()
    {
        // Obtener todos los pedidos
        $pedidos = Pedido::all();
        
        // Pasar los pedidos a la vista
        return view('lista-pedidos', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('productos'); // Carga la relación productos
        return view('pedidos', ['pedido' => $pedido]);
    }
}