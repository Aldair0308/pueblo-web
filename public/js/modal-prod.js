import { 
    renderSingleSelectOptions, 
    renderGroupedSingleSelectOptions, 
    setDefaultSelections, 
    updateTotalPrice, 
    addToCart, 
    styleButton 
} from './modal-functions.js';

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('productModal'); // Contenedor principal del modal
    const extrasContainer = document.getElementById('extrasContainer');
    const customizationContainer = document.getElementById('customizationContainer');
    const carritoWrapper = document.getElementById('carritoWrapper');
    const modalBody = document.querySelector('.modal-body'); // Contenedor del cuerpo con scroll interno
    const escarchadoTitle = document.getElementById('escarchado-title');
    const personalizarSection = document.getElementById('personalizar');
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
        preparados: {
            extras: [
                { name: 'Tamarindo', price: 0 },
                { name: 'Sal y Limón', price: 0 },
                { name: 'Sin escarchar', price: 0 },
            ],
            customization: [
                { name: 'Con sal', group: 'groupA', price: 0 },
                { name: 'Con limón', group: 'groupA', price: 0 },
                { name: 'Sola', group: 'groupA', price: 0 },
            ],
        },
        maruchan: {
            extras: [
                { name: 'Extra queso', price: 10 },
                { name: 'Salsa picante', price: 5 },
            ],
            customization: [
                { name: 'Camarón con habanero', group: 'group1', price: 15 },
                { name: 'Camarón con chile piquín', group: 'group1', price: 0 },
                { name: 'Camarón', group: 'group1', price: 0 },
            ],
        },
        comida: {
            extras: [
                { name: 'Extra queso', price: 10 },
                { name: 'Salsa picante', price: 5 },
            ],
            customization: [
                { name: 'Camarón con habanero', group: 'group1', price: 15 },
                { name: 'Camarón con chile piquín', group: 'group1', price: 0 },
                { name: 'Camarón', group: 'group1', price: 0 },
            ],
        },
        palomitas: {
            extras: [
                { name: 'Extra queso', price: 10 },
                { name: 'Salsa picante', price: 5 },
            ],
            customization: [
                { name: 'Extra mantequilla', group: 'group1', price: 15 },
                { name: 'Mantequilla', group: 'group1', price: 0 },
                { name: 'Natural', group: 'group1', price: 0 },
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
            extras: [],
            customization: [],
        },
    };

    const productMapping = {
        'XX Laguer Chica': 'bebidas',
        'XX Laguer Grande': 'bebidas',
        'XX Ambar Chica': 'bebidas',
        'XX Ambar Grande': 'bebidas',
        'Squirt': 'preparados',
        'Heineken Cero alcohol': 'bebidas',
        'Palomitas': 'paolomitas',
        'Maruchan': 'maruchan',
        'Papas a la francesa': 'papas',
        'Marlboro rojo': 'otros', // Producto no personalizable
        'Marlboro de capsula': 'otros', // Producto no personalizable
    };

    // Nueva función para reiniciar el scroll
    function resetScroll() {
        if (modalBody) modalBody.scrollTo({ top: 0, behavior: 'instant' }); // Restablece el scroll del contenido
        if (modal) modal.scrollTo({ top: 0, behavior: 'instant' }); // Restablece el scroll del modal principal
    }

    window.toggleModal = function (show, product = null) {
        if (show) {
            // Asegúrate de que el scroll esté en la parte superior antes de cualquier cambio
            resetScroll();

            currentProduct = product;
            document.getElementById('modalTitle').textContent = product.nombre;
            document.getElementById('modalPrice').textContent = `MX$${product.precio}`;
            document.getElementById('modalImage').src = product.foto;

            const productGroup = productMapping[product.nombre];

            // Restablecer visibilidad de las secciones
            escarchadoTitle.style.display = 'none';
            personalizarSection.style.display = 'none';

            if (productGroup) {
                const groupOptions = productGroups[productGroup];

                // Limpia los contenedores antes de renderizar
                extrasContainer.innerHTML = '';
                customizationContainer.innerHTML = '';

                // Muestra u oculta las secciones según el grupo del producto
                if (['bebidas', 'preparados'].includes(productGroup)) { 
                    escarchadoTitle.style.display = 'block';
                    renderSingleSelectOptions(extrasContainer, groupOptions.extras);
                    personalizarSection.style.display = 'block';
                    renderGroupedSingleSelectOptions(customizationContainer, groupOptions.customization);
                } else if (productGroup === 'otros') {
                    // No mostrar secciones de extras o personalización
                } else {
                    personalizarSection.style.display = 'block';
                    renderGroupedSingleSelectOptions(customizationContainer, groupOptions.customization);
                }

                // Seleccionar las opciones predeterminadas si corresponde
                setDefaultSelections(productMapping, currentProduct, extrasContainer, customizationContainer);
            }

            currentQuantity = 1;
            document.getElementById('quantity').textContent = currentQuantity;
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
