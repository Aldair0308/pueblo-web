<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdenarController extends Controller
{
    public function ordenarPorNumeroMesa($numeroMesa)
    {
        // Aquí puedes implementar la lógica para mostrar la pantalla dependiendo del número de mesa
        return view('ordenar', ['numeroMesa' => $numeroMesa]);
    }

    // Otros métodos para manejar lógica adicional según sea necesario
}
