<!DOCTYPE html>
<html>
<head>
    <title>419 - Sesión Expirada</title>
</head>
<body>
    <div>
        <p>La sesión ha expirado. Serás redirigido a la página de inicio en unos segundos.</p>
        <script>
            setTimeout(function() {
                window.location.href = "{{ route('home') }}";
            }, 5000); // Redirigir después de 5 segundos (5000 milisegundos)
        </script>
    </div>
</body>
</html>
