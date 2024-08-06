<!doctype html>
<html lang="en">
<head>
    <title>{{ $title }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- Logo -->
        <img src="{{ secure_asset('images/logo.jpg') }}" alt="Company Logo" width="100px" height="100px">
    </header>
    <main>
        <div class="container mt-4">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                </div>
                <div class="card-body">
                    @foreach ($rondas as $date => $rondasByDate)
                        <h5 class="card-title">{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h5>
                        @foreach ($rondasByDate as $ronda)
                            <div class="mb-2">
                                Mesa: {{ $ronda->mesa }}<br>
                                Número de Mesa: {{ $ronda->numeroMesa }}<br>
                                Estado: {{ $ronda->estado }} - {{ \Carbon\Carbon::parse($ronda->timestamp)->format('H:i:s') }}<br>
                                Productos:
                                @php
                                    // Decodificar el JSON de productos
                                    $productos = json_decode($ronda->productos, true);
                                @endphp
                                @if(is_array($productos))
                                    <ul>
                                        @foreach ($productos as $producto)
                                            <li>{{ $producto['nombre'] ?? 'Nombre no disponible' }} - {{ $producto['cantidad'] ?? 'Cantidad no disponible' }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    No hay productos disponibles.
                                @endif
                            </div>
                        @endforeach
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- Footer content -->
        <div class="container mt-4">
            <p class="text-center">© {{ date('Y') }} Tu Empresa. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
