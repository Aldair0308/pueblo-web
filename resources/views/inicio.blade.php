<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="{{ secure_asset('css/styles.css') }}">
    {{-- <script src="{{ secure_asset('js/AuthGoogle.js') }}"></script> --}}
</head>

<body class="container">
    <div>
        <h1>Bienvenido a la mesa {{ $numeroMesa }}</h1>
    </div>
    <!-- Botón para redirigir a la ruta de ordenar -->
    <a href="{{ route('ordenar.por-numero-mesa', ['numerodemesa' => $numeroMesa]) }}" class="btn btn-primary">
        Ordenar
        <x-photo-scroller />

    </a>
    @if (session('user'))
        <div class="info-cliente">
            <img src="{{ session('user')['photo'] }}" alt="Foto de {{ session('user')['first_name'] }}"
                style="width: 100px; height: 100px; border-radius: 50%;">
            <h2>{{ session('user')['first_name'] }} {{ session('user')['last_name'] }}</h2>
        </div>
        <x-Cuenta />
        <x-preparando />
    @else
        <p>No se encontró información del usuario.</p>
    @endif
</body>

</html>
