<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtén el rol del usuario desde el almacenamiento local o sesión
        $userRole = session('userRole'); // o 'auth()->user()->role' si estás usando autenticación

        return view('home', compact('userRole'));
    }

}
