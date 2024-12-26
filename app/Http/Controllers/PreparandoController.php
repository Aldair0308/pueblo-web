<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PreparandoController extends Controller
{
    public function index()
    {
        $user = session('user');
        if (!$user) {
            return response('', 204); // Respuesta vacía si no hay usuario en la sesión
        }

        $firstName = $user['first_name'] ?? '';
        $lastName = $user['last_name'] ?? '';
        $fullName = trim("$firstName $lastName");

        $response = Http::get('https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas');

        if ($response->successful()) {
            $rondas = $response->json();
            $rondasPorPreparar = collect($rondas)->filter(function ($ronda) use ($fullName) {
                return $ronda['estado'] === 'por_preparar' && $ronda['mesa'] === $fullName;
            });

            if ($rondasPorPreparar->isNotEmpty()) {
                return view('components.preparando');
            }
        }

        return response('', 204); // Respuesta vacía si no hay rondas por preparar
    }
}
