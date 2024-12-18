document.addEventListener('DOMContentLoaded', function () {
    const carritoContainer = document.getElementById('carritoItems');
    const totalDisplay = document.getElementById('totalRonda');
    const ordenForm = document.getElementById('ordenForm');
    let totalRonda = 0;

    if (!carritoContainer || !ordenForm) {
        console.error("Carrito o formulario no encontrado en el DOM.");
        return;
    }

    // Recalcular el total de la ronda
    function actualizarTotalRonda() {
        totalRonda = 0;
        const carritoItems = carritoContainer.querySelectorAll('.carrito-item');
        carritoItems.forEach(item => {
            const precio = parseFloat(item.dataset.precio);
            const cantidad = parseInt(item.dataset.cantidad);
            totalRonda += precio * cantidad;
        });
        totalDisplay.textContent = totalRonda.toFixed(2);
    }

    document.addEventListener('add-to-cart', function (event) {
        const { product, cantidad, descripcion } = event.detail;
    
        const carritoItem = document.createElement('div');
        carritoItem.classList.add('carrito-item');
        carritoItem.dataset.precio = product.precio;
        carritoItem.dataset.cantidad = cantidad;
        carritoItem.dataset.nombre = product.nombre;
        carritoItem.dataset.descripcion = descripcion;
    
        // Contenedor principal del item
        const itemContent = document.createElement('div');
        itemContent.classList.add('carrito-item-content');
        itemContent.style.display = 'flex';
        itemContent.style.justifyContent = 'space-between';
        itemContent.style.alignItems = 'center';
        itemContent.style.gap = '15px';
    
        carritoItem.appendChild(itemContent);
    
        // Imagen del producto
        const productImage = document.createElement('img');
        productImage.src = product.foto; // Propiedad "foto" del producto
        productImage.alt = product.nombre;
        productImage.style.width = '60px';
        productImage.style.height = '60px';
        productImage.style.objectFit = 'contain';
        productImage.style.borderRadius = '8px';
        itemContent.appendChild(productImage);
    
        // Información del producto
        const productInfo = document.createElement('div');
        productInfo.classList.add('product-info');
        productInfo.style.flex = '1';
    
        const nombre = document.createElement('p');
        nombre.textContent = product.nombre;
        nombre.classList.add('product-name');
        nombre.style.fontWeight = 'bold';
        nombre.style.fontSize = '1em';
    
        const descripcionTexto = document.createElement('p');
        descripcionTexto.textContent = descripcion ? `Descripción: ${descripcion}` : 'Sin descripción';
        descripcionTexto.classList.add('product-description');
        descripcionTexto.style.fontSize = '0.9em';
        descripcionTexto.style.color = '#666';
    
        productInfo.appendChild(nombre);
        productInfo.appendChild(descripcionTexto);
        itemContent.appendChild(productInfo);
    
        // Controles de cantidad
        const cantidadContainer = document.createElement('div');
        cantidadContainer.classList.add('quantity-controls');
        cantidadContainer.style.display = 'flex';
        cantidadContainer.style.alignItems = 'center';
        cantidadContainer.style.gap = '10px';
    
        const decrementBtn = document.createElement('button');
        decrementBtn.textContent = '-';
        decrementBtn.classList.add('cantidad-btn');
        decrementBtn.style.backgroundColor = '#e60000';
        decrementBtn.style.color = 'white';
        decrementBtn.style.border = 'none';
        decrementBtn.style.width = '30px';
        decrementBtn.style.height = '30px';
        decrementBtn.style.borderRadius = '5px';
        decrementBtn.style.cursor = 'pointer';
        decrementBtn.style.fontSize = '1.2em';
    
        decrementBtn.addEventListener('click', function () {
            let cantidadActual = parseInt(carritoItem.dataset.cantidad);
            if (cantidadActual > 1) {
                cantidadActual--;
                carritoItem.dataset.cantidad = cantidadActual;
                cantidadTexto.textContent = `${cantidadActual}`;
                actualizarTotalRonda();
            }
        });
    
        const cantidadTexto = document.createElement('span');
        cantidadTexto.textContent = `${cantidad}`;
        cantidadTexto.classList.add('cantidad-texto');
        cantidadTexto.style.fontWeight = 'bold';
        cantidadTexto.style.fontSize = '1em';
    
        const incrementBtn = document.createElement('button');
        incrementBtn.textContent = '+';
        incrementBtn.classList.add('cantidad-btn');
        incrementBtn.style.backgroundColor = '#6fe060';
        incrementBtn.style.color = 'white';
        incrementBtn.style.border = 'none';
        incrementBtn.style.width = '30px';
        incrementBtn.style.height = '30px';
        incrementBtn.style.borderRadius = '5px';
        incrementBtn.style.cursor = 'pointer';
        incrementBtn.style.fontSize = '1.2em';
    
        incrementBtn.addEventListener('click', function () {
            let cantidadActual = parseInt(carritoItem.dataset.cantidad);
            cantidadActual++;
            carritoItem.dataset.cantidad = cantidadActual;
            cantidadTexto.textContent = `${cantidadActual}`;
            actualizarTotalRonda();
        });
    
        cantidadContainer.appendChild(decrementBtn);
        cantidadContainer.appendChild(cantidadTexto);
        cantidadContainer.appendChild(incrementBtn);
        itemContent.appendChild(cantidadContainer);
    
        // Ícono de eliminar
        const eliminarBtn = document.createElement('button');
        eliminarBtn.classList.add('eliminar-btn');
        eliminarBtn.innerHTML = '<i class="fas fa-trash"></i>';
        eliminarBtn.style.backgroundColor = 'transparent';
        eliminarBtn.style.color = '#e60000';
        eliminarBtn.style.border = 'none';
        eliminarBtn.style.cursor = 'pointer';
    
        eliminarBtn.addEventListener('click', function () {
            carritoItem.remove();
            actualizarTotalRonda();
        });
    
        itemContent.appendChild(eliminarBtn);
        carritoContainer.appendChild(carritoItem);
        actualizarTotalRonda();
    });
    


    // Ajustar el tamaño del scroll dinámicamente
    function adjustScrollView() {
        const carritoModal = document.querySelector('.modal-carrito-content');
        const carritoItemsContainer = document.querySelector('.carrito-items');
        const totalSection = document.querySelector('.carrito-total');
        const enviarOrdenButton = document.querySelector('.enviar-orden-btn');

        const modalHeight = carritoModal.offsetHeight;
        const reservedSpace = totalSection.offsetHeight + enviarOrdenButton.offsetHeight + 40; // Ajustar el espacio reservado
        carritoItemsContainer.style.maxHeight = `${modalHeight - reservedSpace}px`;
        carritoItemsContainer.style.overflowY = 'auto';
    }

    window.addEventListener('resize', adjustScrollView);
    adjustScrollView(); // Inicializar al cargar


// Enviar el pedido
// ordenForm.addEventListener('submit', function (event) {
//     event.preventDefault();

//     const carritoItems = carritoContainer.querySelectorAll('.carrito-item');
//     const productos = [];
//     const cantidades = [];
//     const descripciones = [];

//     carritoItems.forEach(item => {
//         const nombreProducto = item.dataset.nombre; // Recuperar el nombre del producto del dataset
//         const cantidad = parseInt(item.dataset.cantidad);
//         const descripcion = item.dataset.descripcion || ''; // Recuperar descripción del dataset

//         productos.push(nombreProducto);
//         cantidades.push(cantidad);
//         descripciones.push(descripcion);
//     });

//     const mesa = ordenForm.querySelector('#mesa')?.value || 'Invitado';
//     const numeroMesa = parseInt(ordenForm.querySelector('#numeroMesa')?.value || '0');
//     const estado = ordenForm.querySelector('#estado')?.value || 'por_preparar';
//     const mesero = ordenForm.querySelector('#mesero')?.value || 'Invitado';

//     const totalRondaInt = parseFloat(totalDisplay?.textContent || '0');

//     // Mostrar mensaje de confirmación
//     const confirmar = confirm(`¿Estás seguro de mandar la orden de MX$${totalRondaInt.toFixed(2)}?`);
//     if (!confirmar) {
//         return; // Cancelar el envío si el usuario selecciona "Cancelar"
//     }

//     const orden = {
//         mesa,
//         numeroMesa,
//         estado,
//         mesero,
//         productos,
//         cantidades,
//         descripciones,
//         totalRonda: totalRondaInt,
//     };

//     fetch('https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas', {
//         method: 'POST',
//         body: JSON.stringify(orden),
//         headers: {
//             'Content-Type': 'application/json',
//         },
//     })
//         .then(response => response.json())
//         .then(data => {
//             console.log('Orden enviada:', data);
//             alert('Orden enviada correctamente.');
//             carritoContainer.innerHTML = '';
//             totalRonda = 0;
//             if (totalDisplay) {
//                 totalDisplay.textContent = '0.00';
//             }

//             // Cerrar el modal del carrito después de enviar el pedido
//             const carritoModal = document.getElementById('carrito-modal');
//             if (carritoModal) {
//                 carritoModal.style.display = 'none';
//             }
//         })
//         .catch(error => {
//             console.error('Error al enviar la orden:', error);
//             alert('Hubo un error al enviar la orden.');
//         });
// });

// Enviar el pedido
ordenForm.addEventListener('submit', async function (event) {
    event.preventDefault();

    const carritoItems = carritoContainer.querySelectorAll('.carrito-item');
    const productos = [];
    const cantidades = [];
    const descripciones = [];

    carritoItems.forEach(item => {
        const nombreProducto = item.dataset.nombre; // Recuperar el nombre del producto
        const cantidad = parseInt(item.dataset.cantidad);
        const descripcion = item.dataset.descripcion || '';

        productos.push(nombreProducto);
        cantidades.push(cantidad);
        descripciones.push(descripcion);
    });

    const mesa = ordenForm.querySelector('#mesa')?.value || 'Invitado';
    const numeroMesa = parseInt(ordenForm.querySelector('#numeroMesa')?.value || '0');
    const estado = ordenForm.querySelector('#estado')?.value || 'por_preparar';
    const mesero = ordenForm.querySelector('#mesero')?.value || 'Invitado';

    const totalRondaInt = parseFloat(totalDisplay?.textContent || '0');

    // Mostrar mensaje de confirmación
    const confirmar = confirm(`¿Estás seguro de mandar la orden de MX$${totalRondaInt.toFixed(2)}?`);
    if (!confirmar) {
        return;
    }

    let mesaId = null;

    try {
        // Buscar si existe la mesa por cliente
        const response = await fetch(`https://pueblo-nest-production-5afd.up.railway.app/api/v1/mesas/encontrar/${mesa}`);
        const mesaData = await response.json();

        if (response.ok && mesaData) {
            // Si la mesa existe, tomar su ID
            mesaId = mesaData.id;
            console.log('Mesa encontrada:', mesaId);
        } else {
            // Si no existe, crear una nueva mesa
            const nuevaMesaResponse = await fetch('https://pueblo-nest-production-5afd.up.railway.app/api/v1/mesas', {
                method: 'POST',
                body: JSON.stringify({
                    cliente: mesa,
                    numeroMesa: numeroMesa,
                    mesero: mesero,
                }),
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (!nuevaMesaResponse.ok) throw new Error('Error al crear la mesa.');

            const nuevaMesaData = await nuevaMesaResponse.json();
            mesaId = nuevaMesaData.id;
            console.log('Mesa creada:', mesaId);
        }
    } catch (error) {
        console.error('Error al validar/crear la mesa:', error);
        alert('Hubo un error al validar/crear la mesa.');
        return;
    }

    // Construir y enviar la orden
    const orden = {
        mesaId, // ID de la mesa existente o creada
        estado,
        productos,
        cantidades,
        descripciones,
        totalRonda: totalRondaInt,
    };

    try {
        const response = await fetch('https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas', {
            method: 'POST',
            body: JSON.stringify(orden),
            headers: {
                'Content-Type': 'application/json',
            },
        });

        const data = await response.json();

        if (response.ok) {
            console.log('Orden enviada:', data);
            alert('Orden enviada correctamente.');
            carritoContainer.innerHTML = '';
            totalRonda = 0;
            totalDisplay.textContent = '0.00';

            // Cerrar el modal del carrito después de enviar el pedido
            const carritoModal = document.getElementById('carrito-modal');
            if (carritoModal) {
                carritoModal.style.display = 'none';
            }
        } else {
            throw new Error('Error al enviar la orden.');
        }
    } catch (error) {
        console.error('Error al enviar la orden:', error);
        alert('Hubo un error al enviar la orden.');
    }
});



});
