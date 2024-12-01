document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('productModal');
    const carritoWrapper = document.getElementById('carritoWrapper');
    let currentProduct = null; // Producto actualmente seleccionado

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
            carritoWrapper.style.display = 'none'; // Ocultar el carrito
        } else {
            modal.style.display = 'none';
            carritoWrapper.style.display = 'block'; // Mostrar el carrito
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
            const carritoEvent = new CustomEvent('add-to-cart', {
                detail: { product: currentProduct, cantidad, descripcion },
            });
            document.dispatchEvent(carritoEvent);
            toggleModal(false);
        }
    };
});
