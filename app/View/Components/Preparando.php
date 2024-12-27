<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Preparando extends Controller
{
    public function getRondas()
    {
        $user = session('user');

        if (!$user) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }

        $firstName = $user['first_name'] ?? '';
        $lastName = $user['last_name'] ?? '';
        $fullName = trim("$firstName $lastName");

        // Consultar las rondas desde el endpoint externo
        $response = Http::get('https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas');

        if ($response->successful()) {
            $rondas = $response->json();
            $rondasPorPreparar = collect($rondas)->filter(function ($ronda) use ($fullName) {
                return $ronda['estado'] === 'por_preparar' && $ronda['mesa'] === $fullName;
            });

            return response()->json($rondasPorPreparar->values());
        }

        return response()->json(['message' => 'Error al obtener rondas'], 500);
    }
}
