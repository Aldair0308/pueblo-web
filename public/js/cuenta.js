document.addEventListener('DOMContentLoaded', function () {
    const userName = encodeURIComponent("{{ session('user')['first_name'] }} {{ session('user')['last_name'] }}");
    const resumenCuentaElement = document.getElementById('resumen-cuenta');
    const totalCuentaElement = document.getElementById('total-cuenta');

    // Crear un contenedor para errores
    const errorContainer = document.createElement('div');
    errorContainer.id = 'error-container';
    errorContainer.style.color = 'red';
    document.querySelector('.cuenta').appendChild(errorContainer);

    // Función para mostrar errores
    const showError = (message) => {
        errorContainer.innerHTML = `<p><strong>Error:</strong> ${message}</p>`;
    };

    // Función para llamar a la API
    const fetchData = async (url) => {
        try {
            const response = await fetch(url);
            if (!response.ok) {
                const errorText = await response.text();
                throw new Error(`HTTP ${response.status}: ${errorText}`);
            }
            return await response.json();
        } catch (error) {
            console.error(error);
            showError(error.message);
            throw error;
        }
    };

    // Llamada para obtener el resumen de la cuenta
    fetchData(`https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/resumen/${userName}`)
        .then(data => {
            if (Array.isArray(data)) {
                const resumenHtml = data
                    .map(item => `<li>${item.producto} - Cantidad: ${item.cantidad}</li>`)
                    .join('');
                resumenCuentaElement.innerHTML = `<ul>${resumenHtml}</ul>`;
            } else {
                resumenCuentaElement.innerHTML = '<p>Formato de datos incorrecto del resumen.</p>';
            }
        })
        .catch(() => {
            resumenCuentaElement.innerHTML = '<p>Error al cargar el resumen. Ver detalles arriba.</p>';
        });

    // Llamada para obtener el total de la cuenta
    fetchData(`https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/total/${userName}`)
        .then(data => {
            if (typeof data === 'number') {
                totalCuentaElement.textContent = `$${data.toFixed(2)}`;
            } else {
                totalCuentaElement.textContent = 'Formato de datos incorrecto.';
            }
        })
        .catch(() => {
            totalCuentaElement.textContent = 'Error al cargar el total. Ver detalles arriba.';
        });
});
