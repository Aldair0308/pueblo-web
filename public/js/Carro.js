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

    // Agregar producto al carrito
    window.addToCart = function (product) {
        const cantidad = parseInt(document.getElementById('quantity').textContent);
        const descripcion = document.getElementById('modalDescription').value.trim();

        const carritoItem = document.createElement('div');
        carritoItem.classList.add('carrito-item');
        carritoItem.dataset.precio = product.precio;
        carritoItem.dataset.cantidad = cantidad;

        const nombre = document.createElement('p');
        nombre.textContent = `Producto: ${product.nombre}`;
        carritoItem.appendChild(nombre);

        const cantidadContainer = document.createElement('div');
        cantidadContainer.classList.add('cantidad-controls');

        const decrementBtn = document.createElement('button');
        decrementBtn.textContent = '-';
        decrementBtn.classList.add('cantidad-btn');
        decrementBtn.addEventListener('click', function () {
            const cantidadActual = parseInt(carritoItem.dataset.cantidad);
            if (cantidadActual > 1) {
                carritoItem.dataset.cantidad = cantidadActual - 1;
                cantidadTexto.textContent = `Cantidad: ${carritoItem.dataset.cantidad}`;
                window.actualizarTotalRonda();
            }
        });

        const incrementBtn = document.createElement('button');
        incrementBtn.textContent = '+';
        incrementBtn.classList.add('cantidad-btn');
        incrementBtn.addEventListener('click', function () {
            const cantidadActual = parseInt(carritoItem.dataset.cantidad);
            carritoItem.dataset.cantidad = cantidadActual + 1;
            cantidadTexto.textContent = `Cantidad: ${carritoItem.dataset.cantidad}`;
            window.actualizarTotalRonda();
        });

        cantidadContainer.appendChild(decrementBtn);

        const cantidadTexto = document.createElement('p');
        cantidadTexto.textContent = `Cantidad: ${cantidad}`;
        cantidadContainer.appendChild(cantidadTexto);

        cantidadContainer.appendChild(incrementBtn);
        carritoItem.appendChild(cantidadContainer);

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
            window.actualizarTotalRonda();
        });
        carritoItem.appendChild(eliminarBtn);

        carritoContainer.appendChild(carritoItem);
        window.actualizarTotalRonda();
        toggleModal(false);
    };

});
