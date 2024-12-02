document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('productModal');
    const extrasContainer = document.getElementById('extrasContainer');
    const customizationContainer = document.getElementById('customizationContainer');
    const carritoWrapper = document.getElementById('carritoWrapper');
    const modalBody = document.querySelector('.modal-body'); // Contenedor del cuerpo del modal
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
            renderSingleSelectOptions(extrasContainer, [
                { name: 'Tamarindo', price: 0 },
                { name: 'Sal y Limón', price: 0 },
                { name: 'Sin escarchar', price: 0 },
            ]);

            renderGroupedSingleSelectOptions(customizationContainer, [
                { name: 'Con sal y limon', group: 'group1', price: 0 },
                { name: 'Solo con limon', group: 'group1', price: 0 },
                { name: 'Sola', group: 'group1', price: 0 },
                { name: 'Con clamato', group: 'group2', price: 0 },
                { name: 'Con poco clamato', group: 'group2', price: 0 },
            ]);

            // Reiniciar cantidad a 1 y seleccionar opciones predeterminadas
            currentQuantity = 1;
            document.getElementById('quantity').textContent = currentQuantity;

            // Seleccionar opciones predeterminadas
            setDefaultSelections();

            // Restablecer el scroll del modal a la parte superior
            modal.scrollTop = 0; // Asegura que el modal principal esté arriba
            modalBody.scrollTop = 0; // Asegura que el cuerpo del modal esté arriba

            // Mostrar el precio calculado
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

    // Renderizar opciones dinámicas con selección única
    function renderSingleSelectOptions(container, options) {
        container.innerHTML = ''; // Limpia opciones previas

        options.forEach(option => {
            const label = document.createElement('label');
            label.classList.add('option-label');

            const input = document.createElement('input');
            input.type = 'checkbox';
            input.value = option.name;
            input.dataset.price = option.price;
            input.classList.add('option-input');

            input.addEventListener('change', function () {
                // Desmarca otras opciones si esta se selecciona
                Array.from(container.querySelectorAll('input')).forEach(otherInput => {
                    if (otherInput !== input) otherInput.checked = false;
                });
            });

            const span = document.createElement('span');
            span.textContent = `${option.name} ${option.price > 0 ? `+MX$${option.price}` : ''}`;

            label.appendChild(input);
            label.appendChild(span);
            container.appendChild(label);
        });
    }

    // Renderizar opciones dinámicas agrupadas con selección única por grupo
    function renderGroupedSingleSelectOptions(container, options) {
        container.innerHTML = ''; // Limpia opciones previas

        options.forEach(option => {
            const label = document.createElement('label');
            label.classList.add('option-label');

            const input = document.createElement('input');
            input.type = 'checkbox';
            input.value = option.name;
            input.dataset.price = option.price;
            input.dataset.group = option.group;
            input.classList.add('option-input');

            input.addEventListener('change', function () {
                // Desmarca otras opciones en el mismo grupo si esta se selecciona
                Array.from(container.querySelectorAll(`input[data-group="${option.group}"]`)).forEach(otherInput => {
                    if (otherInput !== input) otherInput.checked = false;
                });
            });

            const span = document.createElement('span');
            span.textContent = `${option.name} ${option.price > 0 ? `+MX$${option.price}` : ''}`;

            label.appendChild(input);
            label.appendChild(span);
            container.appendChild(label);
        });
    }

    // Seleccionar opciones predeterminadas
    function setDefaultSelections() {
        // Seleccionar "Tamarindo" en extras
        const tamarindoInput = extrasContainer.querySelector('input[value="Tamarindo"]');
        if (tamarindoInput) tamarindoInput.checked = true;

        // Seleccionar "Con sal y limon" en personalización
        const conSalYLimonInput = customizationContainer.querySelector('input[value="Con sal y limon"]');
        if (conSalYLimonInput) conSalYLimonInput.checked = true;
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
