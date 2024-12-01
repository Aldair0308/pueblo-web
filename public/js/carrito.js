document.addEventListener('DOMContentLoaded', function () {
    const carritoContainer = document.getElementById('carritoItems'); // Contenedor de los ítems del carrito
    const totalDisplay = document.getElementById('totalRonda'); // Total de la ronda
    const ordenForm = document.getElementById('ordenForm'); // Formulario de envío de la orden
    let totalRonda = 0; // Total acumulado

    if (!carritoContainer || !totalDisplay) {
        console.error("Elementos esenciales del carrito no existen en el DOM.");
        return;
    }

    // Recalcular el total de la ronda
    window.actualizarTotalRonda = function () {
        totalRonda = 0;
        const carritoItems = carritoContainer.querySelectorAll('.carrito-item');
        carritoItems.forEach(item => {
            const precioProducto = parseFloat(item.dataset.precio);
            const cantidadProducto = parseInt(item.dataset.cantidad);
            totalRonda += precioProducto * cantidadProducto;
        });
        totalDisplay.textContent = totalRonda.toFixed(2);
    };

    // Enviar el pedido
    ordenForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const carritoItems = carritoContainer.querySelectorAll('.carrito-item');
        const productos = [];
        const cantidades = [];
        const descripciones = [];

        // Recopilar datos de los productos en el carrito
        carritoItems.forEach(item => {
            const nombreProducto = item.querySelector('p:first-child').textContent.split(': ')[1];
            const cantidad = parseInt(item.dataset.cantidad);
            const descripcion = item.querySelector('p:nth-child(3)')?.textContent.split(': ')[1] || '';

            productos.push(nombreProducto);
            cantidades.push(cantidad);
            descripciones.push(descripcion);
        });

        // Construir el objeto de la orden
        const orden = {
            mesa: 'Mesa 1', // Cambia esto según tu lógica o contexto dinámico
            numeroMesa: 1, // Cambia este valor según sea necesario
            estado: 'por_preparar',
            mesero: 'Juan Pérez', // Cambia esto según tu lógica o contexto
            productos,
            cantidades,
            descripciones,
            totalRonda,
            timestamp: new Date().toISOString(), // Agregar timestamp opcional
        };

        // Validar el cuerpo antes de enviarlo
        if (productos.length === 0 || cantidades.length === 0 || descripciones.length === 0) {
            alert('El carrito está vacío. Agrega productos antes de enviar.');
            return;
        }

        // Enviar la petición al API
        fetch('https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas', {
            method: 'POST',
            body: JSON.stringify(orden),
            headers: {
                'Content-Type': 'application/json',
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Orden enviada:', data);
                alert('Orden enviada correctamente.');
                carritoContainer.innerHTML = ''; // Limpia el carrito después de enviar
                totalRonda = 0; // Reinicia el total
                totalDisplay.textContent = '0.00'; // Actualiza el total en pantalla
            })
            .catch(error => {
                console.error('Error al enviar la orden:', error);
                alert('Hubo un error al enviar la orden. Por favor, inténtalo nuevamente.');
            });
    });
});
