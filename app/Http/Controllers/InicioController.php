<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function inicioPorNumeroMesa($numeroMesa)
    {
        // Obtener los datos del usuario desde la sesión
        $user = session('user');

        // Asegurarse de que los datos básicos estén disponibles
        $name = $user['name'] ?? 'Invitado';
        $lastName = $user['last_name'] ?? '';
        $photo = $user['photo'] ?? '/default-avatar.png';

        return view('inicio', [
            'numeroMesa' => $numeroMesa,
            'name' => $name,
            'lastName' => $lastName,
            'photo' => $photo,
        ]);
    }

}
