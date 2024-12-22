<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdenarController extends Controller
{
    // Definir las propiedades de la clase
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
        // Asignar los valores a las propiedades
        $this->name = $name;
        $this->lastName = $lastName;
        $this->photo = $photo;
    }

    /**
     * Ordenar por número de mesa.
     *
     * @param int $numeroMesa
     * @return \Illuminate\View\View
     */
    public function ordenarPorNumeroMesa($numeroMesa)
    {
        // Aquí puedes realizar cualquier lógica relacionada con el número de mesa
        
        // Llamar al método render para devolver la vista
        return $this->render($numeroMesa);
    }

    /**
     * Renderizar la vista.
     *
     * @param int $numeroMesa
     * @return \Illuminate\View\View
     */
    public function render($numeroMesa)
    {
        return view('ordenar', [
            'numeroMesa' => $numeroMesa,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'photo' => $this->photo,
        ]);
    }
}
