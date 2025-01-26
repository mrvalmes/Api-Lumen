<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';

    protected $fillable = [
        'cliente',
        'smartphone_id',
        'cantidad',
        'monto_total'
    ];
}
