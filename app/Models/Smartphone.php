<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Smartphone extends Model
{
    protected $table = 'smartphones'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'Brand',
        'Model',
        'Ram',
        'Rom',
        'ScreenSize',
        'Battery',
        'Price',
        'Color',
        'CameraPixels',
        'Network',
        'Availability',
        'Img',
    ];

    public $timestamps = true; 
}
