<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Authenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtén el token del encabezado de la solicitud
        $token = $request->bearerToken();

        if (!$token) {
            // No hay token, redirige al login
            return redirect()->route('login');
        }

        // Verifica el token con una solicitud a la API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('https://pueblo-nest-production.up.railway.app/api/v1/auth/profile');

        if ($response->status() === 200) {
            // Token válido, continúa con la solicitud
            return $next($request);
        } else {
            // Token no válido, redirige al login
            return redirect()->route('login');
        }
    }
}
