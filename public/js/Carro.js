document.addEventListener('DOMContentLoaded', function () {
    const carritoContainer = document.getElementById('carritoItems');
    const ordenForm = document.getElementById('ordenForm');
    const totalDisplay = document.getElementById('totalRonda');
    let totalRonda = 0;

    if (!carritoContainer) {
        console.error("El contenedor con ID 'carritoItems' no existe en el DOM.");
        return;
    }

    if (!ordenForm) {
        console.error("El formulario con ID 'ordenForm' no existe en el DOM.");
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

        if (totalDisplay) {
            totalDisplay.textContent = totalRonda.toFixed(2);
        }
    };

});
