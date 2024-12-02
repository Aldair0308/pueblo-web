document.addEventListener('DOMContentLoaded', function () {
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


    const carritoContainer = document.getElementById('carritoItems');

    // Función para agregar controles de cantidad
    function initializeQuantityControls(carritoItem) {
        const decrementBtn = carritoItem.querySelector('.cantidad-btn-decrement');
        const incrementBtn = carritoItem.querySelector('.cantidad-btn-increment');
        const cantidadText = carritoItem.querySelector('.cantidad-text');
        const productPriceElement = carritoItem.querySelector('.product-price');

        const precioProducto = parseFloat(carritoItem.dataset.precio);

        decrementBtn.addEventListener('click', function() {
            let cantidadActual = parseInt(carritoItem.dataset.cantidad);
            if (cantidadActual > 1) {
                cantidadActual--;
                carritoItem.dataset.cantidad = cantidadActual;
                cantidadText.textContent = cantidadActual;
                productPriceElement.textContent =
                    `MX$${(precioProducto * cantidadActual).toFixed(2)}`;
                window.actualizarTotalRonda();
            }
        });

        incrementBtn.addEventListener('click', function() {
            let cantidadActual = parseInt(carritoItem.dataset.cantidad);
            cantidadActual++;
            carritoItem.dataset.cantidad = cantidadActual;
            cantidadText.textContent = cantidadActual;
            productPriceElement.textContent = `MX$${(precioProducto * cantidadActual).toFixed(2)}`;
            window.actualizarTotalRonda();
        });
    }

    // Observador para detectar elementos nuevos
    const observer = new MutationObserver(function(mutationsList) {
        mutationsList.forEach(mutation => {
            mutation.addedNodes.forEach(node => {
                if (node.classList && node.classList.contains('carrito-item')) {
                    initializeQuantityControls(node);
                }
            });
        });
    });

    observer.observe(carritoContainer, {
        childList: true
    });

    // Simulación de añadir un producto con los controles
    window.addToCart = function(product) {
        const carritoItem = document.createElement('div');
        carritoItem.classList.add('carrito-item');
        carritoItem.dataset.precio = product.precio;
        carritoItem.dataset.cantidad = 1;

        carritoItem.innerHTML = `
            <div class="product-info">
                <p class="product-name">Producto: ${product.nombre}</p>
                <p class="product-description">Descripción: ${product.descripcion || 'Sin descripción'}</p>
            </div>
            <div class="product-controls">
                <div class="quantity-controls">
                    <button class="cantidad-btn cantidad-btn-decrement">−</button>
                    <span class="cantidad-text">1</span>
                    <button class="cantidad-btn cantidad-btn-increment">+</button>
                </div>
                <span class="product-price">MX$${product.precio.toFixed(2)}</span>
            </div>
        `;

        carritoContainer.appendChild(carritoItem);
        initializeQuantityControls(carritoItem);
        window.actualizarTotalRonda();
    };
});
