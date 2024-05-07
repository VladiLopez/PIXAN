<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detalles_Productos extends Model
{
    protected $table = 'detallesproductos';

    use SoftDeletes;

    public function comentarios()
    {
      return $this->hasMany(Comentario::class, 'detalle_producto_id');
    }

    public function carritos()
    {
        return $this->hasMany(Carrito::class, 'producto_id');
    }
}
