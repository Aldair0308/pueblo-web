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
        const resumenContainer = document.getElementById('resumen-cuenta');
        const totalCuentaElement = document.getElementById('total-cuenta');
        const resumenCuentaElement1 = document.createElement('div'); // Primera lista
        const resumenCuentaElement2 = document.createElement('div'); // Segunda lista
        let currentVisible = resumenCuentaElement1; // Contenedor visible actual

        // Configuración inicial de los buffers
        resumenCuentaElement1.id = "resumen-cuenta-1";
        resumenCuentaElement2.id = "resumen-cuenta-2";
        resumenCuentaElement1.style.display = "block";
        resumenCuentaElement2.style.display = "none";
        resumenContainer.appendChild(resumenCuentaElement1);
        resumenContainer.appendChild(resumenCuentaElement2);

        let isUpdating = false; // Para evitar múltiples actualizaciones simultáneas

        // Función para convertir el timestamp a formato AM/PM correctamente (usando UTC)
        const formatTime12Hours = (timestamp) => {
            if (!timestamp) return "Hora no disponible";

            const date = new Date(timestamp);
            if (isNaN(date.getTime())) return "Hora no válida";

            let hours = date.getUTCHours();
            const minutes = date.getUTCMinutes();
            const ampm = hours >= 12 ? "PM" : "AM";
            hours = hours % 12 || 12;
            return `${hours}:${minutes < 10 ? "0" : ""}${minutes} ${ampm}`;
        };

        // Función para validar los datos antes de renderizar
        const isValidData = (data) => {
            if (!Array.isArray(data) || data.length === 0) return false;

            return data.every(ronda => {
                if (!ronda || !ronda.productos || !ronda.cantidades || !ronda.descripciones)
                return false;
                if (ronda.productos.some(producto => producto === undefined)) return false;
                if (ronda.cantidades.some(cantidad => cantidad === undefined)) return false;
                if (ronda.descripciones.some(descripcion => descripcion === undefined))
            return false;
                return true;
            });
        };

        // Función para renderizar datos en el buffer no visible
        const renderRondasToBuffer = (data, buffer) => {
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

            buffer.innerHTML = html;
            totalCuentaElement.textContent = `$${totalCuenta.toFixed(2)}`;
        };

        // Función para alternar buffers
        const swapBuffers = () => {
            if (currentVisible === resumenCuentaElement1) {
                resumenCuentaElement1.style.display = "none";
                resumenCuentaElement2.style.display = "block";
                currentVisible = resumenCuentaElement2;
            } else {
                resumenCuentaElement2.style.display = "none";
                resumenCuentaElement1.style.display = "block";
                currentVisible = resumenCuentaElement1;
            }
        };

        // Función para cargar datos de la API
        const fetchRondas = async () => {
            if (isUpdating) return; // Evitar múltiples actualizaciones simultáneas
            isUpdating = true;

            try {
                const response = await fetch(
                    `https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/${userName}`
                );
                if (!response.ok) {
                    throw new Error(`Error HTTP ${response.status}: ${await response.text()}`);
                }

                const data = await response.json();

                if (isValidData(data)) {
                    const nextBuffer = currentVisible === resumenCuentaElement1 ?
                        resumenCuentaElement2 :
                        resumenCuentaElement1;

                    renderRondasToBuffer(data, nextBuffer); // Procesar en el buffer no visible
                    swapBuffers(); // Alternar buffers solo si los datos son válidos
                } else {
                    console.warn("Datos inválidos detectados. Manteniendo la renderización actual.");
                }
            } catch (error) {
                console.error("Error al cargar las rondas:", error);
            } finally {
                isUpdating = false; // Permitir nuevas actualizaciones
            }
        };

        // Primera carga y actualizaciones periódicas
        fetchRondas();
        setInterval(fetchRondas, 3000);
    });
</script>
