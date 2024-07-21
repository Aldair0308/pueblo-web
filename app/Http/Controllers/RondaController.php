<?php

namespace App\Http\Controllers;

use App\Models\Ronda;
use App\Http\Requests\RondaRequest;

/**
 * Class RondaController
 * @package App\Http\Controllers
 */
class RondaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rondas = Ronda::paginate();

        return view('ronda.index', compact('rondas'))
            ->with('i', (request()->input('page', 1) - 1) * $rondas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ronda = new Ronda();
        return view('ronda.create', compact('ronda'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RondaRequest $request)
    {
        Ronda::create($request->validated());

        return redirect()->route('rondas.index')
            ->with('success', 'Ronda created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ronda = Ronda::find($id);

        return view('ronda.show', compact('ronda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ronda = Ronda::find($id);

        return view('ronda.edit', compact('ronda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RondaRequest $request, Ronda $ronda)
    {
        $ronda->update($request->validated());

        return redirect()->route('rondas.index')
            ->with('success', 'Ronda updated successfully');
    }

    public function destroy($id)
    {
        Ronda::find($id)->delete();

        return redirect()->route('rondas.index')
            ->with('success', 'Ronda deleted successfully');
    }
}
