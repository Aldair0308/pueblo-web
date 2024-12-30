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

export function setDefaultSelections(productMapping, currentProduct, extrasContainer, customizationContainer) {
    const defaultSelections = {
        bebidas: { extras: ['Tamarindo'], customization: ['Con sal'] },
        comida: { extras: ['Extra queso'], customization: ['Tamaño grande'] },
    };
    const productGroup = productMapping[currentProduct.nombre];
    if (!productGroup) return;
    const groupDefaults = defaultSelections[productGroup];
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

export function updateTotalPrice(currentProduct, currentQuantity) {
    const basePrice = currentProduct ? currentProduct.precio : 0;
    const totalPrice = basePrice * currentQuantity;
    const button = document.querySelector('.add-to-cart');
    button.innerHTML = `Agregar al Carrito MX$${totalPrice.toFixed(2)}`;
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
