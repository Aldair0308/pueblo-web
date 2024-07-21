<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mesa
 *
 * @property int $id
 * @property int $noMesa
 * @property string|null $cliente
 * @property string $estado
 * @property float $totalCuenta
 * @property \Illuminate\Support\Carbon|null $horaPago
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @package App\Models
 */
class Mesa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mesa'; // Nombre correcto de la tabla en singular

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['noMesa', 'cliente', 'estado', 'totalCuenta', 'horaPago'];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 20;
}
