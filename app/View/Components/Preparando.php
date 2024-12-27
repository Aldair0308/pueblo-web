<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class Preparando extends Component
{
    public $mostrarMensaje = false;

    /**
     * Crear una nueva instancia del componente.
     */
    public function __construct()
    {
        $user = session('user');

        if ($user) {
            $firstName = $user['first_name'] ?? '';
            $lastName = $user['last_name'] ?? '';
            $fullName = trim("$firstName $lastName");

            // Consultar las rondas
            $response = Http::get('https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas');

            if ($response->successful()) {
                $rondas = $response->json();
                $rondasPorPreparar = collect($rondas)->filter(function ($ronda) use ($fullName) {
                    return $ronda['estado'] === 'por_preparar' && $ronda['mesa'] === $fullName;
                });

                $this->mostrarMensaje = $rondasPorPreparar->isNotEmpty();
            }
        }
    }

    /**
     * Obtener la vista del componente.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        if ($this->mostrarMensaje) {
            return view('components.preparando');
        }

        return ''; // No renderiza nada si no hay rondas
    }
}
