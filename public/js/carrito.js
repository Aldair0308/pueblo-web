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

        // Nombre del producto
        const nombre = document.createElement('p');
        nombre.textContent = `Producto: ${product.nombre}`;
        carritoItem.appendChild(nombre);

        // Controles de cantidad
        const cantidadContainer = document.createElement('div');
        cantidadContainer.classList.add('cantidad-container');

        const decrementBtn = document.createElement('button');
        decrementBtn.textContent = '-';
        decrementBtn.classList.add('cantidad-btn');
        decrementBtn.addEventListener('click', function () {
            let cantidadActual = parseInt(carritoItem.dataset.cantidad);
            if (cantidadActual > 1) {
                cantidadActual--;
                carritoItem.dataset.cantidad = cantidadActual;
                cantidadTexto.textContent = `Cantidad: ${cantidadActual}`;
                actualizarTotalRonda();
            }
        });

        const cantidadTexto = document.createElement('p');
        cantidadTexto.textContent = `Cantidad: ${cantidad}`;
        cantidadTexto.classList.add('cantidad-texto');

        const incrementBtn = document.createElement('button');
        incrementBtn.textContent = '+';
        incrementBtn.classList.add('cantidad-btn');
        incrementBtn.addEventListener('click', function () {
            let cantidadActual = parseInt(carritoItem.dataset.cantidad);
            cantidadActual++;
            carritoItem.dataset.cantidad = cantidadActual;
            cantidadTexto.textContent = `Cantidad: ${cantidadActual}`;
            actualizarTotalRonda();
        });

        cantidadContainer.appendChild(decrementBtn);
        cantidadContainer.appendChild(cantidadTexto);
        cantidadContainer.appendChild(incrementBtn);
        carritoItem.appendChild(cantidadContainer);

        // Descripción del producto
        if (descripcion) {
            const descripcionTexto = document.createElement('p');
            descripcionTexto.textContent = `Descripción: ${descripcion}`;
            carritoItem.appendChild(descripcionTexto);
        }

        // Botón de eliminar
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
