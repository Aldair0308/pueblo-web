<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Preparando extends Controller
{
    public function getRondas()
    {
        try {
            // Obtener datos del usuario autenticado desde la sesión
            $user = session('user');

            if (!$user) {
                return response()->json(['message' => 'Usuario no autenticado'], 401);
            }

            $firstName = $user['first_name'] ?? '';
            $lastName = $user['last_name'] ?? '';
            $fullName = trim("$firstName $lastName");

            if (empty($fullName)) {
                return response()->json(['message' => 'Nombre de usuario no válido'], 400);
            }

            // Consultar las rondas desde el endpoint externo
            $response = Http::get('https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas');

            if (!$response->successful()) {
                return response()->json([
                    'message' => 'Error al comunicarse con el servidor externo',
                    'error' => $response->status()
                ], $response->status());
            }

            $rondas = $response->json();

            // Filtrar rondas para el usuario actual
            $rondasPorPreparar = collect($rondas)->filter(function ($ronda) use ($fullName) {
                return isset($ronda['estado'], $ronda['mesa']) &&
                    $ronda['estado'] === 'por_preparar' &&
                    $ronda['mesa'] === $fullName;
            });

            return response()->json($rondasPorPreparar->values());
        } catch (\Exception $e) {
            // Captura cualquier excepción y retorna un mensaje de error
            return response()->json([
                'message' => 'Ocurrió un error interno en el servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
