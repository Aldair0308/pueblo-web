<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdenarController; // Asegúrate de importar el controlador OrdenarController
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RondaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Models\Ronda;
        use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;








/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('ordenar/{numerodemesa}', [OrdenarController::class, 'ordenarPorNumeroMesa'])->name('ordenar.por-numero-mesa');

Route::resource('mesas', MesaController::class);

Route::resource('productos', ProductoController::class);

Route::resource('rondas', RondaController::class);

Route::resource('users', UserController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('ronda/pdf', function () {
    // Realiza la solicitud GET a la API para obtener los datos de las rondas
    $response = Http::get('https://pueblo-nest-production.up.railway.app/api/v1/rondas');

    // Verifica si la solicitud fue exitosa
    if (!$response->successful()) {
        return response()->json(['error' => 'No se pudo obtener datos'], 500);
    }

    // Decodifica la respuesta JSON
    $rondas = $response->json();

    // Filtra rondas de los últimos 7 días
    $sevenDaysAgo = Carbon::now()->subDays(14)->startOfDay();
    $filteredRondas = array_filter($rondas, function ($ronda) use ($sevenDaysAgo) {
        return Carbon::parse($ronda['timestamp'])->gte($sevenDaysAgo);
    });

    // Agrupa las rondas por fecha
    $groupedData = [];
    foreach ($filteredRondas as $ronda) {
        $date = Carbon::parse($ronda['timestamp'])->toDateString();

        if (!isset($groupedData[$date])) {
            $groupedData[$date] = [
                'productos' => []
            ];
        }

        // Agrupa productos
        foreach ($ronda['productos'] as $index => $producto) {
            $cantidad = (int) $ronda['cantidades'][$index];
            if (!isset($groupedData[$date]['productos'][$producto])) {
                $groupedData[$date]['productos'][$producto] = 0;
            }
            $groupedData[$date]['productos'][$producto] += $cantidad;
        }
    }

    // Datos para la vista
    $data = [
        'title' => 'Reporte de Rondas',
        'groupedData' => $groupedData
    ];

    // Carga la vista para el PDF con los datos
    $pdf = Pdf::loadView('ronda.pdf', $data);

    // Devuelve el PDF en lugar de descargarlo, usa stream() para visualizar en el navegador
    return $pdf->stream('reporte.pdf');
})->name('rondas.pdf');


