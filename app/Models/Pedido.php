<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pedido extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detallesproductos()
    {
        return $this->hasMany(PedidoProducto::class, 'pedido_id');
    }

    public function listarPedidos()
    {
        // Obtener todos los pedidos con la relación 'detallesproductos' cargada
        $pedidos = Pedido::with('detallesproductos')->get();
        
        // Pasar los pedidos a la vista
        return view('lista-pedidos', compact('pedidos'));
    }
}
