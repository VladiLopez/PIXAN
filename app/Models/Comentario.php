<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = ['contenido'];

    public function detalleProducto()
    {
        return $this->belongsTo(Detalles_Productos::class);
    }
}
