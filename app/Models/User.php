<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @property $name
 * @property $email
 * @property $password
 * @property $photo
 * @property $rol
 * @property $id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Model
{
    public $timestamps = false;

    protected $table = 'user'; // Nombre correcto de la tabla en singular

    protected $perPage = 200;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'photo', 'rol'];



}
