<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockMateriales extends Model
{
    use HasFactory;
    use SoftDeletes; //QUITAR PARA HACER EL TEST
    protected $table = 'stockmateriales';
}
