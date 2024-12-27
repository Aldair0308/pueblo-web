<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="{{ secure_asset('css/styles.css') }}">
    <script src="{{ secure_asset('js/AuthGoogle.js') }}"></script>
</head>

<body class="container">
    <div>
        <h1>Bienvenido a la mesa {{ $numeroMesa }}</h1>
    </div>
    <!-- Botón para redirigir a la ruta de ordenar -->
    <a href="{{ route('ordenar.por-numero-mesa', ['numerodemesa' => $numeroMesa]) }}" class="btn btn-primary">
        Ordenar
    </a>
    @if (session('user'))
        <div class="info-cliente">
            <img src="{{ session('user')['photo'] }}" alt="Foto de {{ session('user')['first_name'] }}"
                style="width: 100px; height: 100px; border-radius: 50%;">
            <h2>{{ session('user')['first_name'] }} {{ session('user')['last_name'] }}</h2>
        </div>
        <x-Cuenta />

        <!-- Contenedor para el componente x-preparando -->
        <div id="preparando-container"></div>

        <script>
            // Función para agregar el componente x-preparando cada 4 segundos
            function renderPreparando() {
                // Obtener el contenedor donde se agregará el componente
                const container = document.getElementById('preparando-container');

                // Crear un nuevo elemento div para el componente x-preparando
                const preparacion = document.createElement('div');
                preparacion.innerHTML =
                    `@component('x-preparando') @endcomponent`;

                // Agregar el componente al contenedor
                container.appendChild(preparacion);
            }

            // Llamar a la función cada 4 segundos
            setInterval(renderPreparando, 4000);
        </script>
    @else
        <p>No se encontró información del usuario.</p>
    @endif
</body>

</html>
