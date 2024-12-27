<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreparandoController extends Controller
{
    public function index()
    {
        $user = session('user');

        // Verificamos si el usuario está autenticado
        if ($user) {
            $firstName = $user['first_name'] ?? '';
            $lastName = $user['last_name'] ?? '';
            $fullName = trim("$firstName $lastName");

            // Retornamos el fullName al frontend
            return response()->json([
                'fullName' => $fullName
            ]);
        }

        // Si no hay usuario en sesión, retornamos un mensaje de error
        return response()->json([
            'error' => 'Usuario no autenticado'
        ], 401); // Código de estado 401 - Unauthorized
    }
}
