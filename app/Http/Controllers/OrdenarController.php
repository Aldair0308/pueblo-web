<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdenarController extends Controller
{
    public function ordenarPorNumeroMesa($numeroMesa)
    {
        // Obtener los datos del usuario desde la sesión
        $name = session('user.name', 'Invitado');
        $lastName = session('user.last_name', '');
        $photo = session('user.photo', '/default-avatar.png');
        
        // Retornar la vista con los datos
        return view('ordenar', [
            'numeroMesa' => $numeroMesa,
            'name' => $name,
            'lastName' => $lastName,
            'photo' => $photo,
        ]);
    }
}
