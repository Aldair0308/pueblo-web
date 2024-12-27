<div class="flex items-center justify-center h-screen">
    <div class="bg-white rounded-lg shadow-md p-6 text-center w-full max-w-md">
        <h2 class="text-lg font-bold text-gray-800">Estamos preparando tu orden...</h2>
        <p class="text-gray-600 mt-2">Por favor, espera mientras procesamos tu pedido...</p>
    </div>
</div>

<script>
    // Función para hacer la solicitud HTTP cada 3 segundos
    function verificarEstado() {
        fetch('/preparando') // Ruta del controlador que se desea consultar
            .then(response => response.json())
            .then(data => {
                if (data.mensaje) {
                    // Aquí puedes manejar el mensaje o el estado que recibas del servidor
                    console.log(data
                        .mensaje); // Muestra el mensaje en la consola, puedes actualizar la interfaz si lo deseas
                }
            })
            .catch(error => {
                console.error('Error al realizar la solicitud:', error);
            });
    }

    // Llamar a la función cada 3 segundos
    setInterval(verificarEstado, 3000);
</script>
