<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudFactura extends Model
{
    protected $table = 'solicitudes_factura';

    protected $fillable = [
        'rfc', 'nombre', 'codigo_postal', 'regimen_fiscal', 'uso_cfdi', 'email', 'estatus',
    ];
}
