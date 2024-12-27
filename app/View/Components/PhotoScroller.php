<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;

class PhotoScroller extends Component
{
    public $products;

    public function __construct()
    {
        // Llamada al API para obtener los productos
        $response = Http::get('https://pueblo-nest-production-5afd.up.railway.app/api/v1/productos');

        if ($response->successful()) {
            $this->products = $response->json();
        } else {
            $this->products = [];
        }
    }

    /**
     * Renderiza el componente.
     */
    public function render()
    {
        return view('components.photo-scroller');
    }
}
