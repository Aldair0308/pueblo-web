<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Carrito extends Component
{
    public $name;
    public $lastName;
    public $photo;

    /**
     * Crear una nueva instancia del componente.
     *
     * @param string $name
     * @param string $lastName
     * @param string $photo
     */
    public function __construct($name, $lastName, $photo)
    {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->photo = $photo;
    }

    /**
     * Obtener la vista del componente.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.Carrito');
    }
}
