<!DOCTYPE html>
<html>
<head>
    <title>419 - Sesión Expirada</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'warning',
                title: '¡La sesión ha expirado!',
                text: 'Serás redirigido a la página de inicio en unos segundos.',
                timer: 5000, // Tiempo en milisegundos (5 segundos)
                timerProgressBar: true,
                willClose: () => {
                    window.location.href = "{{ route('welcome') }}"; // Redirige a la página de bienvenida
                }
            });
        });
    </script>
</body>
</html>
