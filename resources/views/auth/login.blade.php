<!DOCTYPE html>
<html>
<head>
    <title>Inicia Sesión</title>
    <!--Bootstrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h3>Inicia Sesión</h3>
            </div>
            <div class="card-body">
                <form id="login-form">
                    @csrf
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Correo electrónico" id="email" name="email" required>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Contraseña" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Iniciar" class="btn float-right login_btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#login-form').on('submit', function(event) {
            event.preventDefault(); // Evita el envío normal del formulario

            // Obtén los valores de los campos del formulario
            var email = $('#email').val();
            var password = $('#password').val();

            // Envía los datos a tu backend Laravel
            $.ajax({
                url: '/login', // Ruta para manejar el inicio de sesión en Laravel
                type: 'POST',
                data: {
                    email: email,
                    password: password,
                    _token: '{{ csrf_token() }}' // Token CSRF para la protección
                },
                success: function(response) {
                    // Redirige al usuario a la pantalla de inicio
                    window.location.href = '/home';
                },
                error: function(xhr, status, error) {
                    // Maneja los errores aquí
                    console.error('Error en el login:', status, error);
                    alert('Error en el inicio de sesión. Verifica tus credenciales.');
                }
            });
        });
    });
</script>
</body>
</html>
