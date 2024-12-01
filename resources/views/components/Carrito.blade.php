<div id="carrito" class="carrito-container">
    <div class="carrito-content">
        <h4>Carrito</h4>
        <div id="carritoItems" class="carrito-items">
            <!-- Aquí se agregarán los productos seleccionados dinámicamente -->
        </div>
        <div class="carrito-total">
            <p>Total: $<span id="totalRonda">0.00</span></p>
        </div>
        <button type="submit" form="ordenForm" class="submit-button">Enviar Orden</button>
    </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<script src="{{ asset('js/Carro.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
</script>

<style>
    .carrito-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .product-info {
        flex: 1;
        margin-right: 15px;
    }

    .product-name {
        font-weight: bold;
    }

    .product-description {
        font-size: 0.9em;
        color: #666;
    }

    .product-controls {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .cantidad-btn {
        background-color: #e60000;
        color: white;
        border: none;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        font-size: 1.2em;
        cursor: pointer;
    }

    .cantidad-btn:hover {
        background-color: #bf0000;
    }

    .cantidad-text {
        font-weight: bold;
        font-size: 1em;
        margin: 0 10px;
    }

    .product-price {
        font-weight: bold;
        font-size: 1.1em;
    }

    .cantidad-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cantidad-btn {
        background-color: #e60000;
        color: white;
        border: none;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 5px;
        cursor: pointer;
    }

    .cantidad-btn:hover {
        background-color: #bf0000;
    }

    .cantidad-texto {
        font-size: 1.2em;
        font-weight: bold;
    }

    .eliminar-btn {
        background: none;
        border: none;
        color: #e74c3c;
        font-size: 1.2em;
        cursor: pointer;
        margin-left: 10px;
    }

    .eliminar-btn:hover {
        color: #bf0000;
    }
</style>
