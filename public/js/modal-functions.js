export function renderSingleSelectOptions(container, options) {
    container.innerHTML = '';
    options.forEach(option => {
        const label = document.createElement('label');
        label.classList.add('option-label');
        const input = document.createElement('input');
        input.type = 'checkbox';
        input.value = option.name;
        input.dataset.price = option.price;
        input.classList.add('option-input');
        input.addEventListener('change', function () {
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

export function renderGroupedSingleSelectOptions(container, options) {
    container.innerHTML = '';
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
            if (option.group === 'groupA') {
                handleGroupASelection(container, input);
            } else if (option.group === 'groupB') {
                handleGroupBSelection(); // No se requiere lógica específica para groupB.
            } else {
                Array.from(container.querySelectorAll(`input[data-group="${option.group}"]`)).forEach(otherInput => {
                    if (otherInput !== input) otherInput.checked = false;
                });
            }
        });

        const span = document.createElement('span');
        span.textContent = `${option.name} ${option.price > 0 ? `+MX$${option.price}` : ''}`;
        label.appendChild(input);
        label.appendChild(span);
        container.appendChild(label);
    });
}

/**
 * Lógica específica para manejar selecciones en `groupA`.
 * @param {HTMLElement} container - El contenedor de las opciones.
 * @param {HTMLInputElement} input - El input que ha cambiado.
 */
function handleGroupASelection(container, input) {
    const groupAInputs = Array.from(container.querySelectorAll('input[data-group="groupA"]'));
    const isSolaSelected = input.value === 'Sola';

    if (isSolaSelected && input.checked) {
        // Si se selecciona "Sola", desmarcar las demás opciones del grupo
        groupAInputs.forEach(otherInput => {
            if (otherInput.value !== 'Sola') otherInput.checked = false;
        });
    } else if (!isSolaSelected) {
        // Si no es "Sola", y se selecciona "Con sal" o "Con limón", no desmarcar nada
        const solaInput = groupAInputs.find(otherInput => otherInput.value === 'Sola');
        if (solaInput) solaInput.checked = false;
    }
}

/**
 * Lógica específica para manejar selecciones en `groupB`.
 * 
 * Para `groupB` no es necesario realizar ningún control adicional, 
 * ya que permite múltiples selecciones simultáneas.
 */
function handleGroupBSelection() {
    // No se requiere lógica específica ya que `groupB` permite seleccionar cualquier combinación.
}

export function setDefaultSelections(productMapping, currentProduct, extrasContainer, customizationContainer) {
    const defaultSelections = {
        bebidas: { extras: ['Tamarindo'], customization: ['Con sal', 'Con limón'] },
        comida: { extras: ['Extra queso'], customization: ['Tamaño grande'] },
        papas: { extras: ['Extra queso'], customization: ['Capsu', 'Salsa Valentina', 'Queso amarillo'] },
        palomitas: { extras: ['Extra queso'], customization: ['Extra mantequilla'] },
        maruchan: { extras: ['Extra queso'], customization: ['Camarón con habanero'] },
        preparados: { extras: ['Tamarindo'], customization: ['Con sal', 'Con limón'] },
    };

    const productGroup = productMapping[currentProduct.nombre];
    if (!productGroup) return;

    const groupDefaults = defaultSelections[productGroup];

    // Validar si el grupo tiene propiedades de `extras` o `customization`
    if (groupDefaults) {
        if (groupDefaults.extras) {
            groupDefaults.extras.forEach(extra => {
                const defaultExtra = extrasContainer.querySelector(`input[value="${extra}"]`);
                if (defaultExtra) defaultExtra.checked = true;
            });
        }

        if (groupDefaults.customization) {
            groupDefaults.customization.forEach(customization => {
                const defaultCustomization = customizationContainer.querySelector(`input[value="${customization}"]`);
                if (defaultCustomization) defaultCustomization.checked = true;
            });
        }
    }
}

export function updateTotalPrice(currentProduct, currentQuantity) {
    const basePrice = currentProduct ? currentProduct.precio : 0;
    const totalPrice = basePrice * currentQuantity;
    const button = document.querySelector('.add-to-cart');
    const modalPrice = document.getElementById('modalPrice');
    button.innerHTML = `Agregar al Carrito MX$${totalPrice.toFixed(2)}`;
    styleButton(button, modalPrice);
}

export function styleButton(button, modalPrice) {
    modalPrice.style.margin = '25px 0px 0px 0px';
    modalPrice.style.fontSize = '1.7em';
    modalPrice.style.fontWeight = 'bold';
    button.style.backgroundColor = '#ff6600';
    button.style.color = 'white';
    button.style.border = 'none';
    button.style.padding = '10px 6px 10px 6px';
    button.style.fontSize = '1.2em';
    button.style.fontWeight = 'bold';
    button.style.borderRadius = '50px';
    button.style.cursor = 'pointer';
    button.style.width = '100px';
    button.style.margin = '0px 18px 0px 0px';
    button.onmouseover = function () {
        button.style.backgroundColor = '#bf0000';
    };
    button.onmouseout = function () {
        button.style.backgroundColor = '#e60000';
    };
}

export function addToCart(currentProduct, currentQuantity, extrasContainer, customizationContainer) {
    const selectedExtras = Array.from(extrasContainer.querySelectorAll('input:checked')).map(input => input.value);
    const selectedCustomizations = Array.from(customizationContainer.querySelectorAll('input:checked')).map(input => input.value);
    const descripcion = [...selectedExtras, ...selectedCustomizations].join(' | ');
    const carritoEvent = new CustomEvent('add-to-cart', {
        detail: { product: currentProduct, cantidad: currentQuantity, descripcion },
    });
    document.dispatchEvent(carritoEvent);
}

// **NUEVO**: Restablecer el scroll al abrir el modal
export function resetModalScroll(modalElement) {
    modalElement.scrollTop = 0;
}
