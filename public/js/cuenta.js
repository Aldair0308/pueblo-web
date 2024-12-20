document.addEventListener('DOMContentLoaded', function () {
    // Seleccionar el elemento que contiene el nombre del usuario
    let userName = '';

    try {
        const nameElement = document.querySelector('.cuenta p');
        if (nameElement) {
            const nameText = nameElement.textContent.trim();
            // Asignar directamente el nombre sin codificar
            userName = nameText;
            console.log(`Nombre del usuario obtenido: "${userName}"`);
        } else {
            console.error('Elemento del DOM para el nombre del usuario no encontrado.');
        }
    } catch (error) {
        console.error('Error al intentar obtener el nombre del usuario:', error);
    }

    if (!userName) {
        console.warn('No se pudo obtener el nombre del usuario. Deteniendo ejecución.');
        return;
    }

    const resumenCuentaElement = document.getElementById('resumen-cuenta');
    const totalCuentaElement = document.getElementById('total-cuenta');

    // Crear un contenedor para errores visibles en la página
    const errorContainer = document.createElement('div');
    errorContainer.id = 'error-container';
    errorContainer.style.color = 'red';
    document.querySelector('.cuenta').appendChild(errorContainer);

    // Función para mostrar errores en pantalla
    const showError = (message) => {
        console.error('Error en la página:', message);
        errorContainer.innerHTML = `<p><strong>Error:</strong> ${message}</p>`;
    };

    // Función para realizar una llamada a la API
    const fetchData = async (url, description) => {
        try {
            console.log(`Realizando petición a la API (${description}): ${url}`);
            const response = await fetch(url);
            if (!response.ok) {
                const errorText = await response.text();
                throw new Error(`HTTP ${response.status}: ${errorText}`);
            }
            const data = await response.json();
            console.log(`Respuesta de la API (${description}):`, data);
            return data;
        } catch (error) {
            console.error(`Error al realizar la petición (${description}):`, error);
            showError(`Error al cargar ${description}: ${error.message}`);
            throw error;
        }
    };

    // Función para actualizar los datos de la cuenta
    const updateData = () => {
        // Llamada para obtener el resumen de la cuenta
        fetchData(`https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/resumen/${userName}`, 'resumen de la cuenta')
            .then(data => {
                if (Array.isArray(data)) {
                    const resumenHtml = data
                        .map(item => `<li>${item.producto} - Cantidad: ${item.cantidad}</li>`)
                        .join('');
                    resumenCuentaElement.innerHTML = `<ul>${resumenHtml}</ul>`;
                } else {
                    console.warn('Formato inesperado en la respuesta del resumen de la cuenta:', data);
                    resumenCuentaElement.innerHTML = '<p>Formato de datos incorrecto del resumen.</p>';
                }
            })
            .catch(() => {
                resumenCuentaElement.innerHTML = '<p>Error al cargar el resumen. Ver detalles arriba.</p>';
            });

        // Llamada para obtener el total de la cuenta
        fetchData(`https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/total/${userName}`, 'total de la cuenta')
            .then(data => {
                if (typeof data === 'number') {
                    totalCuentaElement.textContent = `$${data.toFixed(2)}`;
                } else {
                    console.warn('Formato inesperado en la respuesta del total de la cuenta:', data);
                    totalCuentaElement.textContent = 'Formato de datos incorrecto.';
                }
            })
            .catch(() => {
                totalCuentaElement.textContent = 'Error al cargar el total. Ver detalles arriba.';
            });
    };

    // Actualizar los datos inmediatamente al cargar la página
    updateData();

    // Configurar un intervalo para actualizar los datos cada 3 segundos
    setInterval(updateData, 3000);
});
