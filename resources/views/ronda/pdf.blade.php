<!doctype html>
<html lang="en">
<head>
    <title>{{ $title }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>
<body>
    <header>
        <!-- Logo -->
        <img src="{{ secure_asset('images/logo.jpg') }}" alt="Company Logo" width="100px" height="100px">
    </header>
    <main>
        <div class="container mt-4">
            @foreach ($groupedData as $date => $rondasByDate)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($rondasByDate as $ronda)
                            <div class="mb-2">
                                <h6>Mesa: {{ $ronda['mesa'] }} (Mesa {{ $ronda['numeroMesa'] }})</h6>
                                <p>Estado: {{ $ronda['estado'] }}</p>
                                <p>Total Ronda: ${{ $ronda['totalRonda'] }}</p>
                                <p>Productos:</p>
                                <ul>
                                    @foreach ($ronda['productos'] as $producto => $cantidad)
                                        <li>{{ $producto }}: {{ $cantidad }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </main>
    <footer>
        <div class="container mt-4">
            <p class="text-center">© {{ date('Y') }} Tu Empresa. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
