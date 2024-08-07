<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Http\Requests\MesaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$this->isTokenValid($request)) {
            return redirect()->route('login');
        }

        $mesas = Mesa::paginate();

        return view('mesa.index', compact('mesas'))
            ->with('i', (request()->input('page', 1) - 1) * $mesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!$this->isTokenValid($request)) {
            return redirect()->route('login');
        }

        $mesa = new Mesa();
        return view('mesa.create', compact('mesa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MesaRequest $request)
    {
        if (!$this->isTokenValid($request)) {
            return redirect()->route('login');
        }

        Mesa::create($request->validated());

        return redirect()->route('mesas.index')
            ->with('success', 'Mesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        if (!$this->isTokenValid($request)) {
            return redirect()->route('login');
        }

        $mesa = Mesa::find($id);

        return view('mesa.show', compact('mesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        if (!$this->isTokenValid($request)) {
            return redirect()->route('login');
        }

        $mesa = Mesa::find($id);

        return view('mesa.edit', compact('mesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MesaRequest $request, Mesa $mesa)
    {
        if (!$this->isTokenValid($request)) {
            return redirect()->route('login');
        }

        $mesa->update($request->validated());

        return redirect()->route('mesas.index')
            ->with('success', 'Mesa updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        if (!$this->isTokenValid($request)) {
            return redirect()->route('login');
        }

        Mesa::find($id)->delete();

        return redirect()->route('mesas.index')
            ->with('success', 'Mesa deleted successfully');
    }

    /**
     * Check if the token is valid.
     */
    private function isTokenValid(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return false;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('https://pueblo-nest-production.up.railway.app/api/v1/auth/profile');

        return $response->status() === 200;
    }
}
