<div class="flex items-center justify-center h-screen bg-gray-100" id="preparando-container" style="display: none;">
    <div class="bg-white rounded-lg shadow-lg p-8 md:p-10 max-w-lg w-full space-y-6">
        <div class="text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-4">Estamos preparando tu orden...</h2>
            <p class="text-gray-600 text-lg">Por favor, espera mientras procesamos tu pedido...</p>
        </div>

        <!-- Contenedor intermedio para asegurar que el Loading se centra siempre -->
        <div class="flex justify-center items-center">
            <!-- Aquí aplicamos flexbox y centramos el contenido de forma correcta -->
            <div class="flex justify-center items-center h-full"
                style="width: 100%; background-color: rgb(157, 221, 157); display: flex !important; justify-content: center !important; align-items: center !important; height: 100vh !important;">
                <x-Loading />
            </div>
        </div>


        <div class="text-center">
            <p class="text-gray-500 text-sm">Si el proceso toma más de un minuto, intenta actualizar la página.</p>
        </div>
    </div>
</div>

<script>
    // Primero, obtenemos el fullName desde la ruta '/preparando'
    fetch('/preparando')
        .then(response => {
            if (!response.ok) {
                throw new Error('No se pudo obtener el fullName. Usuario no autenticado o error del servidor.');
            }
            return response.json();
        })
        .then(data => {
            const fullName = data.fullName;

            if (fullName) {
                // Si se recibe el fullName, hacemos la petición cada 3 segundos
                setInterval(() => {
                    // Hacer la solicitud a la API externa para verificar el estado de las rondas
                    fetch('https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error al obtener las rondas.');
                            }
                            return response.json();
                        })
                        .then(rondas => {
                            // Filtrar las rondas para ver si hay alguna "por_preparar" y que coincida con la mesa del usuario
                            const rondaPorPreparar = rondas.filter(ronda =>
                                ronda.estado === 'por_preparar' && ronda.mesa === fullName
                            );

                            const container = document.getElementById('preparando-container');

                            if (rondaPorPreparar.length > 0) {
                                // Si hay rondas por preparar, mostrar el contenedor
                                container.style.display = 'flex';
                            } else {
                                // Si no hay rondas por preparar, ocultar el contenedor
                                container.style.display = 'none';
                            }
                        })
                        .catch(error => {
                            console.error('Error al hacer la solicitud a la API externa:', error);
                        });
                }, 3000); // Solicitar cada 3 segundos
            } else {
                console.error('No se recibió el fullName o el usuario no está autenticado.');
            }
        })
        .catch(error => {
            console.error('Error al obtener el fullName:', error);
        });
</script>
