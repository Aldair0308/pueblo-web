<!DOCTYPE html>
<html>
<head>
    <title>Inicia Sesión</title>
    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Custom styles -->
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/login-styles.css') }}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h3>Inicia Sesión</h3>
                <div class="d-flex justify-content-end social_icon">
                    <span><i class="fab fa-facebook-square"></i></span>
                    <span><i class="fab fa-google-plus-square"></i></span>
                    <span><i class="fab fa-twitter-square"></i></span>
                </div>
            </div>
            <div class="card-body">
                <form id="login-form">
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
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    Aún no tienes una cuenta?<a href="{{ route('register') }}">Regístrate</a>
                </div>
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

        // Construye el objeto JSON
        var loginData = {
            email: email,
            password: password
        };

        // Envía los datos a la API externa
        $.ajax({
            url: 'https://pueblo-nest-production.up.railway.app/api/v1/auth/login',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(loginData),
            success: function(response) {
                console.log('Respuesta de la API:', response);

                // Verifica si la respuesta contiene el token
                if (response.token) {
                    // Guarda el token en el almacenamiento local
                    localStorage.setItem('authToken', response.token);

                    // Redirige al usuario a la página de inicio
                    window.location.href = '/home';
                } else {
                    alert('Error: Las credenciales son incorrectas.'); // Ajusta según la respuesta de la API
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en el login:', status, error);
                alert('Error en el inicio de sesión. Verifica tus credenciales.');
            }
        });
    });
});

</script>
</body>
</html>
