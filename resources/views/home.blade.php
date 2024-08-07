<!doctype html>
<html lang="es">
<head>
    <title>Casa</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />
</head>

<body>
    <header>
        <!-- Place navbar here -->
    </header>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Dashboard</div>
                        <div class="card-body">
                            <div class="card-text">
                                <a href="{{ route('mesas.index') }}" class="btn btn-success">Ir a Mesas</a>
                                <button id="logout-button" class="btn btn-danger">Cerrar Sesión</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- Place footer here -->
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"
    ></script>

    <!-- jQuery (required for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Verificar token al cargar la página
            function checkToken() {
                var token = localStorage.getItem('authToken');
                if (!token) {
                    // No hay token, redirige al login
                    window.location.href = '/login';
                } else {
                    // Verifica el token con una solicitud a la API
                    $.ajax({
                        url: 'https://pueblo-nest-production.up.railway.app/api/v1/auth/profile',
                        type: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        success: function(response) {
                            console.log('Token válido:', response);
                            // Aquí podrías manejar la respuesta si es necesario
                        },
                        error: function(xhr) {
                            if (xhr.status === 401) {
                                // Token no válido, redirige al login
                                alert('Necesitas Iniciar Sesiòn');

                                window.location.href = '/login';
                            } else {
                                console.error('Error en la validación del token:', xhr);
                                alert('Error en la validación del token. Intenta de nuevo.');
                            }
                        }
                    });
                }
            }

            // Llama a la función para verificar el token
            checkToken();

            // Manejo del clic en el botón de cerrar sesión
            $('#logout-button').on('click', function() {
                // Elimina el token del almacenamiento local
                localStorage.removeItem('authToken');
                // Redirige al usuario a la página de inicio de sesión
                window.location.href = '/login';
            });
        });
    </script>
</body>
</html>
