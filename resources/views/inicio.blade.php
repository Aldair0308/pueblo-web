<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/AuthGoogle.js') }}"></script>

</head>

<body>
    <div class="container">
        <h1>Bienvenido a la Página de Inicio</h1>
        <p>Esta es la página principal de tu aplicación Laravel.</p>
        <p>Selecciona tus productos y realiza tu pedido para la mesa {{ $numeroMesa }}.</p>

        @if (session('user'))
            <div class="info-cliente">
                <img src="{{ session('user')['photo'] }}" alt="Foto de {{ session('user')['first_name'] }}"
                    style="width: 100px; height: 100px; border-radius: 50%;">
                <h2>{{ session('user')['first_name'] }} {{ session('user')['last_name'] }}</h2>
            </div>
        @else
            <p>No se encontró información del usuario.</p>
        @endif

        <!-- Botón para redirigir a la ruta de ordenar -->
        <a href="{{ route('ordenar.por-numero-mesa', ['numerodemesa' => $numeroMesa]) }}" class="btn btn-primary">
            Ordenar
        </a>
    </div>
</body>

</html>
