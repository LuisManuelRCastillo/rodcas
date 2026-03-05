<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
        protected $table = 'customers';
        protected $primaryKey = 'id';
    protected $fillable = ['name', 'phone', 'email', 'address'];

    public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class, 'id_cliente');
    }

}
