<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property int $id
 * @property string $foto
 * @property string $nombre
 * @property float $precio
 * @property string $descripcion
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @package App\Models
 */
class Producto extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'producto'; // Nombre correcto de la tabla en singular

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['foto', 'nombre', 'precio', 'descripcion'];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 20;
}
