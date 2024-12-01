document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('productModal');
    const extrasContainer = document.getElementById('extrasContainer');
    const customizationContainer = document.getElementById('customizationContainer');
    const carritoWrapper = document.getElementById('carritoWrapper');
    let currentProduct = null;
    let currentQuantity = 1;

    // Abrir o cerrar el modal
    window.toggleModal = function (show, product = null) {
        if (show) {
            currentProduct = product;

            // Actualizar encabezado del modal
            document.getElementById('modalTitle').textContent = product.nombre;
            document.getElementById('modalPrice').textContent = `MX$${product.precio}`;
            document.getElementById('modalImage').src = product.foto;

            // Renderizar extras y personalización
            renderOptions(extrasContainer, [
                { name: 'Tamarindo', price: 0 },
                { name: 'Sal y Limón', price: 0 },
                { name: 'Sin escarchar', price: 0 },
            ], 3);

            renderOptions(customizationContainer, [
                { name: 'Con sal y limon', price: 0 },
                { name: 'Con clamato', price: 0 },
                { name: 'Con poco clamato', price: 0 },
                { name: 'Solo con limon', price: 0 },
                { name: 'Sola', price: 0 },
            ], 5);

            // Reiniciar cantidad y mostrar el precio calculado
            currentQuantity = 1;
            updateTotalPrice();

            // Mostrar el modal y ocultar el carrito
            modal.style.display = 'flex';
            carritoWrapper.style.display = 'none';

            // Deshabilitar scroll en el fondo
            document.body.classList.add('body-no-scroll');
        } else {
            // Ocultar el modal y mostrar el carrito
            modal.style.display = 'none';
            carritoWrapper.style.display = 'block';
            currentProduct = null;

            // Habilitar scroll en el fondo
            document.body.classList.remove('body-no-scroll');
        }
    };

    // Renderizar opciones dinámicas
    function renderOptions(container, options, maxSelections) {
        container.innerHTML = ''; // Limpia opciones previas

        options.forEach(option => {
            const label = document.createElement('label');
            label.classList.add('option-label');

            const input = document.createElement('input');
            input.type = 'checkbox';
            input.value = option.name;
            input.dataset.price = option.price;
            input.classList.add('option-input');

            const span = document.createElement('span');
            span.textContent = `${option.name} ${option.price > 0 ? `+MX$${option.price}` : ''}`;

            label.appendChild(input);
            label.appendChild(span);
            container.appendChild(label);
        });

        // Manejar el límite de selección
        container.addEventListener('change', function (event) {
            const selectedOptions = Array.from(container.querySelectorAll('input:checked'));
            if (selectedOptions.length > maxSelections) {
                event.target.checked = false;
                alert(`Puedes seleccionar hasta ${maxSelections} opciones.`);
            }
        });
    }

    // Actualizar la cantidad y recalcular el precio total
    window.updateQuantity = function (change) {
        currentQuantity += change;
        if (currentQuantity < 1) currentQuantity = 1;
        document.getElementById('quantity').textContent = currentQuantity;
        updateTotalPrice();
    };

    // Calcular y mostrar el precio total
    function updateTotalPrice() {
        const basePrice = currentProduct ? currentProduct.precio : 0;
        const totalPrice = basePrice * currentQuantity;
        document.querySelector('.add-to-cart').innerHTML = `Agregar al Carrito MX$${totalPrice.toFixed(2)}`;
    }

    // Agregar al carrito
    window.addToCart = function () {
        const selectedExtras = Array.from(extrasContainer.querySelectorAll('input:checked')).map(input => input.value);
        const selectedCustomizations = Array.from(customizationContainer.querySelectorAll('input:checked')).map(input => input.value);

        const descripcion = [...selectedExtras, ...selectedCustomizations].join(' | ');

        // Despachar evento para agregar al carrito
        const carritoEvent = new CustomEvent('add-to-cart', {
            detail: { product: currentProduct, cantidad: currentQuantity, descripcion },
        });
        document.dispatchEvent(carritoEvent);

        // Ocultar el modal y mostrar el carrito
        toggleModal(false);
    };
});
