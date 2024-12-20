document.addEventListener('DOMContentLoaded', function () {
    // Obtener los datos del usuario desde la sesión
    const userName = encodeURIComponent("{{ session('user')['first_name'] }} {{ session('user')['last_name'] }}");
    const resumenCuentaElement = document.getElementById('resumen-cuenta');
    const totalCuentaElement = document.getElementById('total-cuenta');

    // Validar si los elementos existen
    if (!resumenCuentaElement || !totalCuentaElement) {
        console.error("Elementos del DOM no encontrados.");
        return;
    }

    // Función para realizar una llamada a la API
    const fetchData = async (url) => {
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Error en la respuesta de la API: ${response.statusText}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error al obtener los datos de la API:', error);
            throw error; // Propagar el error para manejarlo en el contexto que llama esta función
        }
    };

    // Cargar el resumen de la cuenta
    fetchData(`https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/resumen/${userName}`)
        .then(data => {
            if (Array.isArray(data)) {
                const resumenHtml = data.map(item => `<li>${item.producto} - Cantidad: ${item.cantidad}</li>`).join('');
                resumenCuentaElement.innerHTML = `<ul>${resumenHtml}</ul>`;
            } else {
                resumenCuentaElement.innerHTML = '<p>Formato de datos incorrecto.</p>';
            }
        })
        .catch(() => {
            resumenCuentaElement.innerHTML = '<p>Error al cargar el resumen de la cuenta.</p>';
        });

    // Cargar el total de la cuenta
    fetchData(`https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/total/${userName}`)
        .then(data => {
            if (typeof data === 'number') {
                totalCuentaElement.textContent = `$${data.toFixed(2)}`; // Formato monetario
            } else {
                totalCuentaElement.textContent = 'Formato de datos incorrecto.';
            }
        })
        .catch(() => {
            totalCuentaElement.textContent = 'Error al cargar el total.';
        });
});
