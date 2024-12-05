<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirige al usuario a Google para iniciar sesión.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle()
    {
        \Log::info('Redirigiendo al flujo de Google OAuth');
        return Socialite::driver('google')->redirect();
    }

    /**
     * Maneja el callback de Google después de la autenticación.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            \Log::info('Inicio del flujo de autenticación con Google');

            // Obtener los datos del usuario desde Google
            $googleUser = Socialite::driver('google')->stateless()->user();
            \Log::info('Datos del usuario obtenido de Google:', [
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'avatar' => $googleUser->getAvatar(),
            ]);

            // Dividir el nombre completo en nombre y apellido
            $fullName = $googleUser->getName();
            $nameParts = explode(' ', $fullName, 2);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? ''; // Si no hay apellido, dejarlo vacío

            // Descargar la foto del usuario y guardarla localmente
            $photoUrl = $googleUser->getAvatar();
            $photoPath = 'avatars/' . $googleUser->getId() . '.jpg';
            \Log::info('Descargando y almacenando la foto del usuario:', ['photo_url' => $photoUrl]);
            $photoContents = file_get_contents($photoUrl);
            Storage::disk('public')->put($photoPath, $photoContents);

            // Obtener la URL pública de la foto
            $localPhotoUrl = Storage::url($photoPath);

            // Verificar si el usuario ya existe en tu API
            \Log::info('Verificando si el usuario ya existe en la API', [
                'email' => $googleUser->getEmail(),
            ]);
            $existingUserResponse = Http::get('https://pueblo-nest-production-5afd.up.railway.app/api/v1/users', [
                'email' => $googleUser->getEmail(),
            ]);

            if ($existingUserResponse->successful() && count($existingUserResponse->json()) > 0) {
                \Log::info('El usuario ya existe en la API');
                $user = $existingUserResponse->json()[0];
                session(['user' => array_merge($user, [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'photo' => $localPhotoUrl,
                ])]);

                return redirect('/inicio');
            }

            // Preparar el cuerpo de la solicitud de registro
            $body = [
                'name' => $fullName,
                'email' => $googleUser->getEmail(),
                'password' => 'default-password',
                'photo' => $localPhotoUrl,
            ];
            \Log::info('Registrando un nuevo usuario en la API', $body);

            // Si no existe, registrar el usuario en el API
            $response = Http::post('https://pueblo-nest-production-5afd.up.railway.app/api/v1/auth/register', $body);

            if ($response->successful()) {
                \Log::info('El usuario fue registrado exitosamente en la API');
                $user = $response->json();
                session(['user' => array_merge($user, [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'photo' => $localPhotoUrl,
                ])]);

                return redirect('/inicio');
            }

            \Log::error('Error al registrar al usuario en la API', ['response_body' => $response->body()]);
            return redirect()->route('login')->withErrors('Error al registrar al usuario en el sistema.');
        } catch (\Exception $e) {
            \Log::error('Error inesperado durante el flujo de autenticación:', [
                'exception_message' => $e->getMessage(),
            ]);

            return redirect()->route('welcome')->withErrors('Ocurrió un error durante la autenticación.');
        }
    }
}
