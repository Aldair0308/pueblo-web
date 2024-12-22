<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function inicioPorNumeroMesa($numeroMesa)
    {
        // Obtener los datos del usuario desde la sesión
        $user = session('user');

        // Asegurarse de que los datos básicos estén disponibles
        $name = $user['name'] ?? 'Invitado';
        $lastName = $user['last_name'] ?? '';
        $photo = $user['photo'] ?? '/default-avatar.png';

        // Almacenar los datos en la sesión para que estén disponibles en la página siguiente
        session([
            'user.name' => $name,
            'user.last_name' => $lastName,
            'user.photo' => $photo,
        ]);

        return view('inicio', [
            'numeroMesa' => $numeroMesa,
            'name' => $name,
            'lastName' => $lastName,
            'photo' => $photo,
        ]);
    }
}
