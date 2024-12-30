import { 
    renderSingleSelectOptions, 
    renderGroupedSingleSelectOptions, 
    setDefaultSelections, 
    updateTotalPrice, 
    addToCart, 
    styleButton 
} from './modal-functions.js';

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
                { name: 'Con sal', group: 'groupA', price: 0 },
                { name: 'Con limón', group: 'groupA', price: 0 },
                { name: 'Sola', group: 'groupA', price: 0 },
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
        papas: {
            extras: [
                { name: 'Extra queso', price: 10 },
            ],
            customization: [
                { name: 'Capsu', group: 'groupB', price: 0 },
                { name: 'Salsa Valentina', group: 'groupB', price: 0 },
                { name: 'Queso amarillo', group: 'groupB', price: 0 },
            ],
        },
        otros: {
            // Productos que no necesitan extras ni personalización
        },
    };

    const productMapping = {
        'XX Laguer Chica': 'bebidas',
        'XX Laguer Grande': 'bebidas',
        'XX Ambar Chica': 'bebidas',
        'XX Ambar Grande': 'bebidas',
        'Squirt': 'bebidas',
        'Heineken Cero alcohol': 'bebidas',
        'Palomitas': 'comida',
        'Maruchan': 'comida',
        'Papas a la francesa': 'papas',
        'Marlboro rojo': 'otros',
        'Marlboro de capsula': 'otros',
    };

    window.toggleModal = function (show, product = null) {
        if (show) {
            currentProduct = product;
            document.getElementById('modalTitle').textContent = product.nombre;
            document.getElementById('modalPrice').textContent = `MX$${product.precio}`;
            document.getElementById('modalImage').src = product.foto;
            const productGroup = productMapping[product.nombre];
            if (productGroup) {
                const groupOptions = productGroups[productGroup];
                extrasContainer.innerHTML = '';
                customizationContainer.innerHTML = '';
                if (productGroup === 'bebidas') {
                    document.getElementById('escarchado-title').style.display = 'block';
                    renderSingleSelectOptions(extrasContainer, groupOptions.extras);
                } else if (productGroup === 'otros') {
                    // Ocultar extras y personalización para productos "otros"
                    document.getElementById('escarchado-title').style.display = 'none';
                    document.getElementById('personalizar').style.display = 'none';
                } else {
                    document.getElementById('escarchado-title').style.display = 'none';
                    document.getElementById('personalizar').style.display = 'block';
                    renderGroupedSingleSelectOptions(customizationContainer, groupOptions.customization);
                }
                setDefaultSelections(productMapping, currentProduct, extrasContainer, customizationContainer);
            }
            currentQuantity = 1;
            document.getElementById('quantity').textContent = currentQuantity;
            modal.scrollTop = 0;
            modalBody.scrollTop = 0;
            updateTotalPrice(currentProduct, currentQuantity);
            modal.style.display = 'flex';
            carritoWrapper.style.display = 'none';
            document.body.classList.add('body-no-scroll');
        } else {
            modal.style.display = 'none';
            carritoWrapper.style.display = 'block';
            currentProduct = null;
            document.body.classList.remove('body-no-scroll');
        }
    };

    window.updateQuantity = function (change) {
        currentQuantity += change;
        if (currentQuantity < 1) currentQuantity = 1;
        document.getElementById('quantity').textContent = currentQuantity;
        updateTotalPrice(currentProduct, currentQuantity);
    };

    window.addToCart = function () {
        addToCart(currentProduct, currentQuantity, extrasContainer, customizationContainer);
        toggleModal(false);
    };
});
