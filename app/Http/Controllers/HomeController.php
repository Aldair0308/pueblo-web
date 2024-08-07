<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Puedes mantener el middleware 'auth' si necesitas autenticar usuarios
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Obtén el token del almacenamiento local en el lado del servidor
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
            // Token válido, muestra la vista de inicio
            return view('home');
        } else {
            // Token no válido, redirige al login
            return redirect()->route('login');
        }
    }
}
