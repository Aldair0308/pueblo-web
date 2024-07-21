<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $foto
 * @property $nombre
 * @property $descripcion
 * @property $id
 * @property $precio
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    public $timestamps = false;

    protected $table = 'producto'; // Nombre correcto de la tabla en singular
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['foto', 'nombre', 'descripcion', 'precio'];



}
