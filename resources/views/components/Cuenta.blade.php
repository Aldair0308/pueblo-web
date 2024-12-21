<div class="cuenta">
    <h2>Resumen de la Cuenta</h2>
    @if (session('user'))
        <p><strong>Nombre:</strong> {{ session('user')['first_name'] }} {{ session('user')['last_name'] }}</p>
        <div id="resumen-cuenta">
            <p>Cargando resumen de la cuenta...</p>
        </div>
        <div class="total-cuenta">
            <p><strong>Total de la cuenta:</strong> $<span id="total-cuenta">Cargando...</span></p>
        </div>
        <script src="{{ secure_asset('js/cuenta.js') }}"></script>
    @else
        <p>No se encontró información del usuario.</p>
    @endif
</div>

<style>
    .cuenta {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }

    .cuenta h2 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #333;
        text-align: center;
    }

    .cuenta p {
        font-size: 16px;
        color: #555;
        margin-bottom: 10px;
    }

    #resumen-cuenta {
        margin: 10px 0;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    #resumen-cuenta ul {
        list-style: none;
        padding: 0;
    }

    #resumen-cuenta li {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    #resumen-cuenta li:last-child {
        border-bottom: none;
    }

    .ronda {
        margin-bottom: 15px;
        padding: 10px;
        background-color: #f1f1f1;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .ronda-header {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .ronda-producto {
        margin-left: 15px;
        font-size: 14px;
        color: #666;
    }

    .total-cuenta {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        text-align: right;
        margin-top: 20px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userName = encodeURIComponent(
            "{{ session('user')['first_name'] }} {{ session('user')['last_name'] }}"
        );
        const resumenCuentaElement = document.getElementById('resumen-cuenta');
        const totalCuentaElement = document.getElementById('total-cuenta');
        let lastData = null; // Variable para almacenar los datos previos

        // Función para convertir el timestamp a formato AM/PM correctamente (usando UTC)
        const formatTime12Hours = (timestamp) => {
            if (!timestamp) return "Hora no disponible";

            const date = new Date(timestamp);
            if (isNaN(date.getTime())) return "Hora no válida";

            let hours = date.getUTCHours(); // Usar getUTCHours para manejar el formato en Zulu Time
            const minutes = date.getUTCMinutes();
            const ampm = hours >= 12 ? "PM" : "AM";
            hours = hours % 12 || 12; // Convertir la hora a formato de 12 horas
            return `${hours}:${minutes < 10 ? "0" : ""}${minutes} ${ampm}`;
        };

        // Función para renderizar las rondas en el DOM
        const renderRondas = (data) => {
            if (!data || data.length === 0) {
                resumenCuentaElement.innerHTML = '<p>No hay datos disponibles para mostrar.</p>';
                return;
            }

            let totalCuenta = 0;
            const html = data.map(ronda => {
                totalCuenta += ronda.totalRonda;
                return `
                <div class="ronda">
                    <div class="ronda-header">Ronda #${ronda.id} - Mesa: ${ronda.numeroMesa} - ${formatTime12Hours(ronda.timestamp)}</div>
                    ${ronda.productos.map((producto, index) => `
                        <div class="ronda-producto">
                            ${producto || 'Sin producto'} (Cantidad: ${ronda.cantidades[index] || '0'}) - ${ronda.descripciones[index] || 'Sin descripción'}
                        </div>
                    `).join('')}
                    <div><strong>Total de la ronda:</strong> $${ronda.totalRonda.toFixed(2)}</div>
                </div>
            `;
            }).join('');
            resumenCuentaElement.innerHTML = html;
            totalCuentaElement.textContent = `$${totalCuenta.toFixed(2)}`;
        };

        // Función para cargar las rondas sin parpadeos
        const fetchRondas = async () => {
            try {
                console.log(
                    `Realizando petición a la API (resumen de la cuenta): https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/${userName}`
                    );
                const response = await fetch(
                    `https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/${userName}`
                );
                if (!response.ok) {
                    throw new Error(`Error HTTP ${response.status}: ${await response.text()}`);
                }
                const data = await response.json();
                console.log("Respuesta de la API (resumen de la cuenta):", data);

                // Actualizar solo si hay datos nuevos
                if (!lastData || JSON.stringify(data) !== JSON.stringify(lastData)) {
                    lastData = data;
                    renderRondas(data);
                }
            } catch (error) {
                console.error('Error al cargar las rondas:', error);
                if (!lastData) {
                    resumenCuentaElement.innerHTML =
                        '<p>Error al cargar el resumen de la cuenta. Intenta nuevamente.</p>';
                }
            }
        };

        // Cargar las rondas al inicio y actualizar cada 3 segundos sin parpadeos
        fetchRondas();
        setInterval(fetchRondas, 3000);
    });
</script>
