document.addEventListener('DOMContentLoaded', function () {
    const userName = encodeURIComponent("{{ session('user')['first_name'] }} {{ session('user')['last_name'] }}");
    const resumenCuentaElement = document.getElementById('resumen-cuenta');
    const totalCuentaElement = document.getElementById('total-cuenta');

    // Crear un contenedor para mostrar errores en pantalla
    const errorContainer = document.createElement('div');
    errorContainer.id = 'error-container';
    errorContainer.style.color = 'red';
    errorContainer.style.marginTop = '10px';
    document.querySelector('.cuenta').appendChild(errorContainer);

    // Función para mostrar errores en pantalla
    const showError = (message) => {
        errorContainer.innerHTML = `<p><strong>Error:</strong> ${message}</p>`;
    };

    // Función para realizar una llamada a la API
    const fetchData = async (url, element) => {
        try {
            const response = await fetch(url);
            if (!response.ok) {
                const errorText = await response.text(); // Obtener respuesta como texto para depuración
                throw new Error(`HTTP ${response.status}: ${errorText}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error al obtener los datos de la API:', error);
            showError(error.message); // Mostrar el error en pantalla
            throw error; // Repropagar el error
        }
    };

    // Cargar el resumen de la cuenta
    fetchData(`https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/resumen/${userName}`, resumenCuentaElement)
        .then(data => {
            if (Array.isArray(data)) {
                const resumenHtml = data.map(item => `<li>${item.producto} - Cantidad: ${item.cantidad}</li>`).join('');
                resumenCuentaElement.innerHTML = `<ul>${resumenHtml}</ul>`;
            } else {
                resumenCuentaElement.innerHTML = '<p>Formato de datos incorrecto.</p>';
            }
        })
        .catch(() => {
            resumenCuentaElement.innerHTML = '<p>No se pudo cargar el resumen de la cuenta. Ver detalles del error arriba.</p>';
        });

    // Cargar el total de la cuenta
    fetchData(`https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/total/${userName}`, totalCuentaElement)
        .then(data => {
            if (typeof data === 'number') {
                totalCuentaElement.textContent = `$${data.toFixed(2)}`; // Formato monetario
            } else {
                totalCuentaElement.textContent = 'Formato de datos incorrecto.';
            }
        })
        .catch(() => {
            totalCuentaElement.textContent = 'No se pudo cargar el total. Ver detalles del error arriba.';
        });
});
