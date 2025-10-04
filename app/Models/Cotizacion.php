<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    //
    protected $table = 'cotizaciones';
    protected $primaryKey = 'id_cotizacion';
    public $timestamps = false;
    protected $fillable = ['id_cliente', 'subtotal', 'iva', 'total', 'estatus'];


    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function detalles()
    {
        return $this->hasMany(CotizacionDetalle::class, 'id_cotizacion');
    }
}
