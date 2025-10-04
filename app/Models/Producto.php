<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
     protected $primaryKey = 'id_producto';
     protected $fillable = [
        
        'codigo',
        'producto',
        'p_costo',
        'p_venta',
        'p_mayoreo',
        'existencia',
        'inv_min',
        'inv_max',
        'dpto'

    ];

    // Si tu tabla no tiene timestamps (created_at, updated_at)
    public $timestamps = false;
}
