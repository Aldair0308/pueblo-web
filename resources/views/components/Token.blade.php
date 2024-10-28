<!-- resources/views/components/token.blade.php -->
<div>
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
                        url: 'https://pueblo-nest-production-5afd.up.railway.app/api/v1/auth/profile',
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
                                alert('Necesitas Iniciar Sesión');
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
</div>
