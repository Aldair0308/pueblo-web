document.addEventListener('DOMContentLoaded', function () {
    const productosContainer = document.getElementById('productosContainer');
    const carritoContainer = document.getElementById('carrito');
    let totalRonda = 0;

    function agregarAlCarrito(producto, cantidad, descripcion) {
        const carritoItem = document.createElement('div');
        carritoItem.classList.add('carrito-item');

        const nombre = document.createElement('p');
        nombre.textContent = `Producto: ${producto.nombre}`;
        carritoItem.appendChild(nombre);

        const cantidadTexto = document.createElement('p');
        cantidadTexto.textContent = `Cantidad: ${cantidad}`;
        carritoItem.appendChild(cantidadTexto);

        if (descripcion) {
            const descripcionTexto = document.createElement('p');
            descripcionTexto.textContent = `Descripción: ${descripcion}`;
            carritoItem.appendChild(descripcionTexto);
        }

        const eliminarBtn = document.createElement('button');
        eliminarBtn.textContent = 'Eliminar';
        eliminarBtn.classList.add('cantidad-btn');
        eliminarBtn.style.backgroundColor = '#e74c3c';
        eliminarBtn.style.marginLeft = '10px';
        eliminarBtn.addEventListener('click', function () {
            carritoItem.remove();
            restarTotalRonda(producto.precio, cantidad);
        });
        carritoItem.appendChild(eliminarBtn);

        carritoContainer.appendChild(carritoItem);

        calcularTotalRonda(producto.precio, cantidad);
    }

    function calcularTotalRonda(precioProducto, cantidad) {
        totalRonda += precioProducto * cantidad;
    }

    function restarTotalRonda(precioProducto, cantidad) {
        totalRonda -= precioProducto * cantidad;
    }

    fetch('https://pueblo-nest-production-5afd.up.railway.app/api/v1/productos')
        .then(response => response.json())
        .then(data => {
            productosContainer.innerHTML = '';

            data.forEach(producto => {
                const card = document.createElement('div');
                card.classList.add('card-producto');

                const imagen = document.createElement('img');
                imagen.src = producto.foto;
                imagen.alt = producto.nombre;
                card.appendChild(imagen);

                const nombre = document.createElement('h4');
                nombre.textContent = producto.nombre;
                card.appendChild(nombre);

                const precio = document.createElement('p');
                precio.textContent = `Precio: ${producto.precio}`;
                card.appendChild(precio);

                const descripcionInput = document.createElement('textarea');
                descripcionInput.placeholder = 'Escribe una descripción...';
                descripcionInput.classList.add('descripcion-input');
                card.appendChild(descripcionInput);

                const cantidadContainer = document.createElement('div');
                cantidadContainer.classList.add('cantidad-container');

                const cantidadLabel = document.createElement('label');
                cantidadLabel.textContent = 'Cantidad:';
                cantidadContainer.appendChild(cantidadLabel);

                const cantidadInput = document.createElement('input');
                cantidadInput.type = 'number';
                cantidadInput.classList.add('cantidad-input');
                cantidadInput.value = '0';
                cantidadInput.min = '0';
                cantidadContainer.appendChild(cantidadInput);

                const incrementBtn = document.createElement('button');
                incrementBtn.classList.add('cantidad-btn');
                incrementBtn.textContent = '+';
                cantidadContainer.appendChild(incrementBtn);

                const decrementBtn = document.createElement('button');
                decrementBtn.classList.add('cantidad-btn');
                decrementBtn.textContent = '-';
                cantidadContainer.appendChild(decrementBtn);

                const agregarBtn = document.createElement('button');
                agregarBtn.textContent = 'Agregar al Carrito';
                agregarBtn.classList.add('cantidad-btn', 'agregar-btn');
                cantidadContainer.appendChild(agregarBtn);

                card.appendChild(cantidadContainer);

                incrementBtn.addEventListener('click', function () {
                    cantidadInput.value = parseInt(cantidadInput.value) + 1;
                });

                decrementBtn.addEventListener('click', function () {
                    const currentValue = parseInt(cantidadInput.value);
                    if (currentValue > 0) cantidadInput.value = currentValue - 1;
                });

                agregarBtn.addEventListener('click', function () {
                    const cantidad = parseInt(cantidadInput.value);
                    const descripcion = descripcionInput.value.trim();

                    if (cantidad > 0) {
                        agregarAlCarrito(producto, cantidad, descripcion);
                        calcularTotalRonda(producto.precio, cantidad);
                        cantidadInput.value = '0';
                        descripcionInput.value = '';
                    } else {
                        alert('Selecciona al menos una unidad del producto.');
                    }
                });

                productosContainer.appendChild(card);
            });
        })
        .catch(error => {
            console.error('Error al obtener los productos:', error);
            alert('Hubo un error al obtener los productos');
        });

    // document.getElementById('ordenForm').addEventListener('submit', function (event) {
    //     event.preventDefault();

    //     const formData = new FormData(this);

    //     const carritoItems = carritoContainer.getElementsByClassName('carrito-item');
    //     const productos = [];
    //     const cantidades = [];
    //     const descripciones = [];

    //     for (let item of carritoItems) {
    //         const nombreProducto = item.querySelector('p:first-child').textContent.split(': ')[1];
    //         const cantidad = parseInt(item.querySelector('p:nth-child(2)').textContent.split(': ')[1]);
    //         const descripcion = item.querySelector('p:nth-child(3)')?.textContent.split(': ')[1] || '';

    //         productos.push(nombreProducto);
    //         cantidades.push(cantidad);
    //         descripciones.push(descripcion);
    //     }

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
        
    //             // Limpiar el carrito
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
        
    //             // Regresar a la página anterior en el historial
    //             window.history.back(); // Esto hace que el navegador regrese a la página anterior
    //         })
    //         .catch(error => {
    //             console.error('Error al enviar la orden:', error);
    //             alert('Hubo un error al enviar la orden.');
    //         });
    // });
});
