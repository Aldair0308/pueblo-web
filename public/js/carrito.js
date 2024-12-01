document.addEventListener('DOMContentLoaded', function () {
    const carritoContainer = document.getElementById('carritoItems');
    const totalDisplay = document.getElementById('totalRonda');
    const ordenForm = document.getElementById('ordenForm');
    let totalRonda = 0;

    if (!carritoContainer || !ordenForm) {
        console.error("Carrito o formulario no encontrado en el DOM.");
        return;
    }

    // Recalcular el total de la ronda
    function actualizarTotalRonda() {
        totalRonda = 0;
        const carritoItems = carritoContainer.querySelectorAll('.carrito-item');
        carritoItems.forEach(item => {
            const precio = parseFloat(item.dataset.precio);
            const cantidad = parseInt(item.dataset.cantidad);
            totalRonda += precio * cantidad;
        });
        totalDisplay.textContent = totalRonda.toFixed(2);
    }

    // Escuchar evento de agregar al carrito
    document.addEventListener('add-to-cart', function (event) {
        const { product, cantidad, descripcion } = event.detail;

        const carritoItem = document.createElement('div');
        carritoItem.classList.add('carrito-item');
        carritoItem.dataset.precio = product.precio;
        carritoItem.dataset.cantidad = cantidad;

        const nombre = document.createElement('p');
        nombre.textContent = `Producto: ${product.nombre}`;
        carritoItem.appendChild(nombre);

        const cantidadTexto = document.createElement('p');
        cantidadTexto.textContent = `Cantidad: ${cantidad}`;
        carritoItem.appendChild(cantidadTexto);

        if (descripcion) {
            const descripcionTexto = document.createElement('p');
            descripcionTexto.textContent = `Descripción: ${descripcion}`;
            carritoItem.appendChild(descripcionTexto);
        }

        const eliminarBtn = document.createElement('button');
        eliminarBtn.textContent = 'Eliminar';
        eliminarBtn.classList.add('cantidad-btn');
        eliminarBtn.style.backgroundColor = '#e74c3c';
        eliminarBtn.addEventListener('click', function () {
            carritoItem.remove();
            actualizarTotalRonda();
        });
        carritoItem.appendChild(eliminarBtn);

        carritoContainer.appendChild(carritoItem);
        actualizarTotalRonda();
    });

    
});
