<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Preparando extends Controller
{
    public function index()
    {
        $user = session('user');

        // Si hay un usuario en sesión
        if ($user) {
            $firstName = $user['first_name'] ?? '';
            $lastName = $user['last_name'] ?? '';
            $fullName = trim("$firstName $lastName");

            // Retornamos el fullName al frontend
            return response()->json([
                'fullName' => $fullName
            ]);
        }

        // Si no hay usuario, regresamos una respuesta vacía o false
        return response()->json([
            'fullName' => null
        ]);
    }
}
