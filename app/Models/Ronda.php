<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ronda
 *
 * @property int $id
 * @property string $mesa
 * @property int $numeroMesa
 * @property string $estado
 * @property string $mesero
 * @property float $totalRonda
 * @property \Illuminate\Support\Carbon $timestamp
 * @property \Illuminate\Support\Carbon|null $deletedAt
 * @property array $productos
 * @property array $cantidades
 * @property array $descripciones
 *
 * @package App\Models
 */
class Ronda extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;

    protected $table = 'ronda'; // Nombre correcto de la tabla en singular

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'productos' => 'array',
        'cantidades' => 'array',
        'descripciones' => 'array',
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 2000;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['mesa', 'numeroMesa', 'estado', 'mesero', 'totalRonda', 'timestamp', 'deletedAt', 'productos', 'cantidades', 'descripciones'];
}
