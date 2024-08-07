<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Http\Requests\MesaRequest;

/**
 * Class MesaController
 * @package App\Http\Controllers
 */
class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mesas = Mesa::paginate();

        return view('mesa.index', compact('mesas'))
            ->with('i', (request()->input('page', 1) - 1) * $mesas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mesa = new Mesa();
        return view('mesa.create', compact('mesa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MesaRequest $request)
    {
        Mesa::create($request->validated());

        return redirect()->route('mesas.index')
            ->with('success', 'Mesa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mesa = Mesa::find($id);

        return view('mesa.show', compact('mesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mesa = Mesa::find($id);

        return view('mesa.edit', compact('mesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MesaRequest $request, Mesa $mesa)
    {
        $mesa->update($request->validated());

        return redirect()->route('mesas.index')
            ->with('success', 'Mesa updated successfully');
    }

    public function destroy($id)
    {
        Mesa::find($id)->delete();

        return redirect()->route('mesas.index')
            ->with('success', 'Mesa deleted successfully');
    }
}
