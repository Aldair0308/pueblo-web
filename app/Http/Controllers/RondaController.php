<?php

namespace App\Http\Controllers;

use App\Models\Ronda;
use App\Http\Requests\RondaRequest;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function generatePdf()
    {
        // Hacer la solicitud GET a la API
        $response = Http::get('https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas');

        if ($response->successful()) {
            $rondas = $response->json();
        } else {
            // Manejar el error de la solicitud
            return response()->json(['error' => 'No se pudo obtener datos'], 500);
        }

        // Filtrar rondas de los últimos 7 días
        $sevenDaysAgo = now()->subDays(7)->startOfDay();
        $filteredRondas = array_filter($rondas, function($ronda) use ($sevenDaysAgo) {
            return \Carbon\Carbon::parse($ronda['timestamp'])->gte($sevenDaysAgo);
        });

        // Agrupar por fecha y por producto
        $groupedData = [];
        foreach ($filteredRondas as $ronda) {
            $date = \Carbon\Carbon::parse($ronda['timestamp'])->toDateString();

            if (!isset($groupedData[$date])) {
                $groupedData[$date] = [];
            }

            $productsMap = [];
            foreach ($ronda['productos'] as $index => $producto) {
                $cantidad = (int) $ronda['cantidades'][$index];
                if (!isset($productsMap[$producto])) {
                    $productsMap[$producto] = 0;
                }
                $productsMap[$producto] += $cantidad;
            }

            $groupedData[$date][] = [
                'mesa' => $ronda['mesa'],
                'numeroMesa' => $ronda['numeroMesa'],
                'estado' => $ronda['estado'],
                'totalRonda' => $ronda['totalRonda'],
                'productos' => $productsMap
            ];
        }

        // Cargar la vista con los datos
        $pdf = Pdf::loadView('ronda.pdf', ['title' => 'Reporte de Rondas', 'groupedData' => $groupedData]);

        return $pdf->stream('reporte.pdf');
    }
}
