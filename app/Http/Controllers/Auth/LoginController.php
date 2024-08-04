<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    // Redirige a la página de inicio después de iniciar sesión
    protected $redirectTo = '/home';

    /**
     * Maneja el inicio de sesión del usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Valida la solicitud
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Realiza la solicitud a la API para autenticarse
        $response = Http::post('https://pueblo-nest-production.up.railway.app/api/v1/auth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $data = $response->json();

        // Verifica la respuesta
        if (isset($data['email'])) {
            // Aquí puedes usar un token de autenticación si es necesario
            Auth::loginUsingId($data['id']); // Supón que `id` es el identificador del usuario
            return redirect($this->redirectTo);
        }

        // En caso de error
        return back()->withErrors(['email' => 'Las credenciales son incorrectas.']);
    }
}
