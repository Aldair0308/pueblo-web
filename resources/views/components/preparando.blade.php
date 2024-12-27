<div id="preparando-container"></div>

<script>
    async function fetchRondas() {
        try {
            const response = await fetch('/api/rondas');
            if (!response.ok) {
                throw new Error(`Error en la petición: ${response.statusText}`);
            }

            const rondas = await response.json();

            const container = document.getElementById('preparando-container');
            if (rondas.length > 0) {
                container.innerHTML = `
                    <div class="flex items-center justify-center h-screen">
                        <div class="bg-white rounded-lg shadow-md p-6 text-center w-full max-w-md">
                            <h2 class="text-lg font-bold text-gray-800">Estamos preparando tu orden...</h2>
                            <p class="text-gray-600 mt-2">Por favor, espera mientras procesamos tu pedido.</p>
                        </div>
                    </div>
                `;
            } else {
                container.innerHTML = '';
            }
        } catch (error) {
            console.error('Error al obtener las rondas:', error);
        }
    }

    // Ejecutar la función cada 4 segundos
    setInterval(fetchRondas, 4000);
    fetchRondas(); // Ejecutar inmediatamente la primera vez
</script>
