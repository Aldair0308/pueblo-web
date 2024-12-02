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

    // Escuchar evento de agregar al carrito
    document.addEventListener('add-to-cart', function (event) {
        const { product, cantidad, descripcion } = event.detail;

        const carritoItem = document.createElement('div');
        carritoItem.classList.add('carrito-item');
        carritoItem.dataset.precio = product.precio;
        carritoItem.dataset.cantidad = cantidad;
        carritoItem.dataset.nombre = product.nombre; // Agregar nombre del producto al dataset
        carritoItem.dataset.descripcion = descripcion; // Agregar descripción al dataset

        // Nombre del producto
        const nombre = document.createElement('p');
        nombre.textContent = `Producto: ${product.nombre}`;
        carritoItem.appendChild(nombre);

        // Controles de cantidad en fila
        const cantidadContainer = document.createElement('div');
        cantidadContainer.classList.add('cantidad-container');

        const decrementBtn = document.createElement('button');
        decrementBtn.textContent = '-';
        decrementBtn.classList.add('cantidad-btn');
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

        const incrementBtn = document.createElement('button');
        incrementBtn.textContent = '+';
        incrementBtn.classList.add('cantidad-btn');
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
        carritoItem.appendChild(cantidadContainer);

        // Descripción del producto
        if (descripcion) {
            const descripcionTexto = document.createElement('p');
            descripcionTexto.textContent = `Descripción: ${descripcion}`;
            carritoItem.appendChild(descripcionTexto);
        }

        // Ícono de eliminar
        const eliminarBtn = document.createElement('button');
        eliminarBtn.classList.add('eliminar-btn');
        eliminarBtn.innerHTML = '<i class="fas fa-trash"></i>'; // Font Awesome trash icon
        eliminarBtn.addEventListener('click', function () {
            carritoItem.remove();
            actualizarTotalRonda();
        });
        carritoItem.appendChild(eliminarBtn);

        carritoContainer.appendChild(carritoItem);
        actualizarTotalRonda();
    });

// Enviar el pedido
ordenForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const carritoItems = carritoContainer.querySelectorAll('.carrito-item');
    const productos = [];
    const cantidades = [];
    const descripciones = [];

    carritoItems.forEach(item => {
        const nombreProducto = item.dataset.nombre; // Recuperar el nombre del producto del dataset
        const cantidad = parseInt(item.dataset.cantidad);
        const descripcion = item.dataset.descripcion || ''; // Recuperar descripción del dataset

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
        return; // Cancelar el envío si el usuario selecciona "Cancelar"
    }

    const orden = {
        mesa,
        numeroMesa,
        estado,
        mesero,
        productos,
        cantidades,
        descripciones,
        totalRonda: totalRondaInt,
    };

    fetch('https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas', {
        method: 'POST',
        body: JSON.stringify(orden),
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then(response => response.json())
        .then(data => {
            console.log('Orden enviada:', data);
            alert('Orden enviada correctamente.');
            carritoContainer.innerHTML = '';
            totalRonda = 0;
            if (totalDisplay) {
                totalDisplay.textContent = '0.00';
            }

            // Cerrar el modal del carrito después de enviar el pedido
            const carritoModal = document.getElementById('carrito-modal');
            if (carritoModal) {
                carritoModal.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error al enviar la orden:', error);
            alert('Hubo un error al enviar la orden.');
        });
});


});
