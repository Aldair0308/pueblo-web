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
            // Función que agregará el componente x-preparando cada 4 segundos
            function mostrarPreparando() {
                // Crear el componente x-preparando como un contenedor HTML
                const preparacionHTML = `
                    <div class="preparando-component">
                        <x-preparando />
                    </div>
                `;

                // Obtener el contenedor donde agregar el nuevo componente
                const container = document.getElementById('preparando-container');

                // Agregar el HTML generado al contenedor
                container.innerHTML = preparacionHTML;
            }

            // Llamar a la función cada 4 segundos para mostrar el componente
            setInterval(mostrarPreparando, 4000);
        </script>
    @else
        <p>No se encontró información del usuario.</p>
    @endif
</body>

</html>
