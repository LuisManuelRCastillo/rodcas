<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CotizacionDetalle extends Model
{
     protected $table = 'cotizacion_detalles';
       public $timestamps = false;
    protected $fillable = ['id_cotizacion', 'id_producto', 'cantidad', 'precio_unitario'];

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class, 'id_cotizacion');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
