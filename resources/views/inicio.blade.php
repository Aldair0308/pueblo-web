<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <h1>Bienvenido a la Página de Inicio</h1>
        <p>Esta es la página principal de tu aplicación Laravel.</p>
        @if (session('user'))
            <div class="info-cliente">
                <img src="{{ session('user')['photo'] }}" alt="Foto de {{ session('user')['first_name'] }}"
                    style="width: 100px; height: 100px; border-radius: 50%;">
                <h2>{{ session('user')['first_name'] }} {{ session('user')['last_name'] }}</h2>
            </div>
        @else
            <p>No se encontró información del usuario.</p>
        @endif
    </div>
</body>

</html>
