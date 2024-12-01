document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('productModal');
    const carritoWrapper = document.getElementById('carritoWrapper');
    const carritoContainer = document.getElementById('carritoItems');
    let currentProduct = null;

    // Abrir o cerrar el modal
    window.toggleModal = function (show, product = null) {
        if (show) {
            currentProduct = product;
            document.getElementById('modalTitle').textContent = product.nombre;
            document.getElementById('modalPrice').textContent = `MX$${product.precio}`;
            document.getElementById('modalImage').src = product.foto;
            document.getElementById('modalDescription').value = '';
            document.getElementById('quantity').textContent = '1';

            modal.style.display = 'flex';
            carritoWrapper.style.display = 'none';
        } else {
            modal.style.display = 'none';
            carritoWrapper.style.display = 'block';
            currentProduct = null;
        }
    };

    // Actualizar la cantidad en el modal
    window.updateQuantity = function (change) {
        const quantity = document.getElementById('quantity');
        let current = parseInt(quantity.textContent);
        if (current + change > 0) {
            quantity.textContent = current + change;
        }
    };

    // Agregar el producto al carrito desde el modal
    window.addToCart = function () {
        const cantidad = parseInt(document.getElementById('quantity').textContent);
        const descripcion = document.getElementById('modalDescription').value.trim();

        if (currentProduct) {
            const carritoItem = document.createElement('div');
            carritoItem.classList.add('carrito-item');

            carritoItem.dataset.precio = currentProduct.precio;
            carritoItem.dataset.cantidad = cantidad;

            const nombre = document.createElement('p');
            nombre.textContent = `Producto: ${currentProduct.nombre}`;
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
                window.actualizarTotalRonda();
            });
            carritoItem.appendChild(eliminarBtn);

            carritoContainer.appendChild(carritoItem);
            window.actualizarTotalRonda();
            toggleModal(false); // Cierra el modal
        }
    };
});
