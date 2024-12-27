<div class="flex items-center justify-center h-screen">
    <div class="bg-white rounded-lg shadow-md p-6 text-center w-full max-w-md">
        <h2 class="text-lg font-bold text-gray-800">Estamos preparando tu orden...</h2>
        <p class="text-gray-600 mt-2">Por favor, espera mientras procesamos tu pedido...</p>
    </div>
</div>

<script>
    // Función para hacer la solicitud HTTP cada 3 segundos
    function verificarEstado() {
        fetch('/preparando') // Ruta que consulta el estado
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json(); // Convierte la respuesta a JSON
            })
            .then(data => {
                if (data.mensaje) {
                    console.log(data.mensaje); // Muestra el mensaje en la consola
                    // Aquí puedes manejar el mensaje recibido, por ejemplo, mostrarlo en la interfaz
                }
            })
            .catch(error => {
                console.error('Error al realizar la solicitud:', error);
            });
    }

    // Llamar a la función cada 3 segundos
    setInterval(verificarEstado, 3000);
</script>
