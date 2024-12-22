<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdenarController extends Controller
{
    // Propiedades de la clase
    public $name;
    public $lastName;
    public $photo;
    
    // El constructor ahora solo se utiliza para otros propósitos si es necesario
    public function __construct()
    {
        // No necesitas inyectar parámetros como $name, $lastName, $photo
    }

    public function ordenarPorNumeroMesa($numeroMesa, Request $request)
    {
        // Obtener los valores desde la solicitud HTTP
        $this->name = $request->input('name');
        $this->lastName = $request->input('lastName');
        $this->photo = $request->input('photo');
        
        // Llamar al método render para devolver la vista
        return $this->render($numeroMesa);
    }

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
