<div id="carrito" class="carrito-container">
    <div class="carrito-content">
        <h4>Carrito</h4>
        <div id="carritoItems" class="carrito-items">
            <!-- Aquí se agregarán los productos seleccionados dinámicamente -->
        </div>
        <div class="carrito-total">
            <p>Total: $<span id="totalRonda">0.00</span></p>
        </div>
        <button type="submit" form="ordenForm" class="submit-button">Enviar Orden</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carritoContainer = document.getElementById('carritoItems'); // Contenedor de los ítems del carrito
        const ordenForm = document.getElementById('ordenForm'); // Formulario de la orden
        const totalDisplay = document.getElementById('totalRonda'); // Elemento para mostrar el total
        let totalRonda = 0; // Total acumulado

        if (!carritoContainer) {
            console.error("El contenedor con ID 'carritoItems' no existe en el DOM.");
            return;
        }

        if (!ordenForm) {
            console.error("El formulario con ID 'ordenForm' no existe en el DOM.");
            return;
        }

        // Recalcular el total de la ronda
        window.actualizarTotalRonda = function() {
            totalRonda = 0;
            const carritoItems = carritoContainer.querySelectorAll('.carrito-item');
            carritoItems.forEach(item => {
                const precioProducto = parseFloat(item.dataset.precio);
                const cantidadProducto = parseInt(item.dataset.cantidad);
                totalRonda += precioProducto * cantidadProducto;
            });

            if (totalDisplay) {
                totalDisplay.textContent = totalRonda.toFixed(2); // Actualizar visualmente
            }
        };

        // Agregar producto al carrito
        window.addToCart = function(product) {
            const cantidad = parseInt(document.getElementById('quantity').textContent);
            const descripcion = document.getElementById('modalDescription').value.trim();

            const carritoItem = document.createElement('div');
            carritoItem.classList.add('carrito-item');
            carritoItem.dataset.precio = product.precio;
            carritoItem.dataset.cantidad = cantidad;

            const nombre = document.createElement('p');
            nombre.textContent = `Producto: ${product.nombre}`;
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
            eliminarBtn.addEventListener('click', function() {
                carritoItem.remove();
                window.actualizarTotalRonda(); // Llama a la función global
            });
            carritoItem.appendChild(eliminarBtn);

            carritoContainer.appendChild(carritoItem);
            window.actualizarTotalRonda(); // Actualiza el total
            toggleModal(false); // Cierra el modal
        };

        // Enviar el pedido
        ordenForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const carritoItems = carritoContainer.querySelectorAll('.carrito-item');
            const productos = [];
            const cantidades = [];
            const descripciones = [];

            carritoItems.forEach(item => {
                const nombreProducto = item.querySelector('p:first-child').textContent.split(
                    ': ')[1];
                const cantidad = parseInt(item.dataset.cantidad);
                const descripcion = item.querySelector('p:nth-child(3)')?.textContent.split(
                    ': ')[1] || '';

                productos.push(nombreProducto);
                cantidades.push(cantidad);
                descripciones.push(descripcion);
            });

            const mesa = ordenForm.querySelector('#mesa')?.value || 'Invitado';
            const numeroMesa = parseInt(ordenForm.querySelector('#numeroMesa')?.value || '0');
            const estado = ordenForm.querySelector('#estado')?.value || 'por_preparar';
            const mesero = ordenForm.querySelector('#mesero')?.value || 'Invitado';

            // Asegurar que totalRonda se calcula correctamente antes de enviarlo
            const totalRondaInt = parseInt(totalDisplay?.textContent || '0', 10);

            const orden = {
                mesa,
                numeroMesa,
                estado,
                mesero,
                productos,
                cantidades,
                descripciones,
                totalRonda: totalRondaInt, // Asegurarnos de que sea un entero
            };

            console.log('JSON para la API:', orden);

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
                    carritoContainer.innerHTML = ''; // Limpia el carrito
                    totalRonda = 0; // Reinicia el total
                    if (totalDisplay) {
                        totalDisplay.textContent = '0.00'; // Actualiza el total en pantalla
                    }
                })
                .catch(error => {
                    console.error('Error al enviar la orden:', error);
                    alert('Hubo un error al enviar la orden.');
                });
        });
    });
</script>
