document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('productModal');
    const extrasContainer = document.getElementById('extrasContainer');
    const customizationContainer = document.getElementById('customizationContainer');
    const carritoWrapper = document.getElementById('carritoWrapper');
    const modalBody = document.querySelector('.modal-body'); // Contenedor del cuerpo del modal
    let currentProduct = null;
    let currentQuantity = 1;

    const productGroups = {
        bebidas: {
            extras: [
                { name: 'Tamarindo', price: 0 },
                { name: 'Sal y Limón', price: 0 },
                { name: 'Sin escarchar', price: 0 },
            ],
            customization: [
                { name: 'Con sal y limon', group: 'group1', price: 0 },
                { name: 'Solo con limon', group: 'group1', price: 0 },
                { name: 'Sola', group: 'group1', price: 0 },
                { name: 'Con clamato', group: 'group2', price: 0 },
                { name: 'Con poco clamato', group: 'group2', price: 0 },
            ],
        },
        comida: {
            extras: [
                { name: 'Extra queso', price: 10 },
                { name: 'Salsa picante', price: 5 },
            ],
            customization: [
                { name: 'Tamaño grande', group: 'group1', price: 15 },
                { name: 'Tamaño mediano', group: 'group1', price: 0 },
            ],
        },
    };
    
    const productMapping = {
        'Laguer chica': 'bebidas',
        'Ambar chica': 'bebidas',
        'Laguer grande': 'bebidas',
        'Ambar grande': 'bebidas',
        'Palomitas': 'comida',
        'Maruchan': 'comida',
    };

    // Abrir o cerrar el modal
    window.toggleModal = function (show, product = null) {
        if (show) {
            currentProduct = product;
    
            // Actualizar encabezado del modal
            document.getElementById('modalTitle').textContent = product.nombre;
            document.getElementById('modalPrice').textContent = `MX$${product.precio}`;
            document.getElementById('modalImage').src = product.foto;
    
            // Determinar grupo del producto
            const productGroup = productMapping[product.nombre];
    
            if (productGroup) {
                // Renderizar las opciones correspondientes al grupo
                const groupOptions = productGroups[productGroup];
                renderSingleSelectOptions(extrasContainer, groupOptions.extras);
                renderGroupedSingleSelectOptions(customizationContainer, groupOptions.customization);
            } else {
                // Si no se encuentra el grupo, limpiar las opciones
                extrasContainer.innerHTML = '';
                customizationContainer.innerHTML = '';
            }
    
            // Reiniciar cantidad a 1 y seleccionar opciones predeterminadas
            currentQuantity = 1;
            document.getElementById('quantity').textContent = currentQuantity;
    
            // Seleccionar opciones predeterminadas
            function setDefaultSelections() {
                // Seleccionar la primera opción en Extras (si existe)
                const firstExtra = extrasContainer.querySelector('input');
                if (firstExtra) firstExtra.checked = true;
            
                // Seleccionar la primera opción de Personalización por grupo (si existe)
                const groups = new Set(
                    Array.from(customizationContainer.querySelectorAll('input')).map(input => input.dataset.group)
                );
                groups.forEach(group => {
                    const firstOption = customizationContainer.querySelector(`input[data-group="${group}"]`);
                    if (firstOption) firstOption.checked = true;
                });
            }
            
    
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
    
    // Seleccionar el botón
    const button = document.querySelector('.add-to-cart');
    
    // Actualizar el texto del botón con el precio
    button.innerHTML = `Agregar al Carrito MX$${totalPrice.toFixed(2)}`;
    
    // Estilizar el botón
    modalPrice.style.margin = '25px 0px 0px 0px'; // Espaciado inferior
    modalPrice.style.fontSize = '1.7em'; // Tamaño de la fuente
    modalPrice.style.fontWeight = 'bold'; // Negrita

    button.style.backgroundColor = '#ff6600'; // Color de fondo
    button.style.color = 'white'; // Color del texto
    button.style.border = 'none'; // Sin borde
    button.style.padding = '10px 6px 10px 6px'; // Espaciado interno
    button.style.fontSize = '1.2em'; // Tamaño de la fuente
    button.style.fontWeight = 'bold'; // Negrita
    button.style.borderRadius = '50px'; // Bordes redondeados
    button.style.cursor = 'pointer'; // Cursor de puntero al pasar
    button.style.width = '100px'; // Ancho completo
    button.style.margin = '0px 18px 0px 0px'; // Ancho completo
    
    // Efecto hover
    button.onmouseover = function() {
        button.style.backgroundColor = '#bf0000'; // Color más oscuro al pasar el ratón
    }
    
    button.onmouseout = function() {
        button.style.backgroundColor = '#e60000'; // Regresa al color original
    }
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
