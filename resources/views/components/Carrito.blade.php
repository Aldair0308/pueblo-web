<!-- Carrito.blade.php -->
<div id="carrito" class="carrito-container">
    <h4>Carrito de Compras</h4>
    <!-- Aquí se mostrarán los productos seleccionados -->
</div>

<script>
    const carritoContainer = document.getElementById('carrito');
    let totalRonda = 0; // Variable para calcular el total de la ronda

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
        eliminarBtn.addEventListener('click', function() {
            carritoItem.remove();
            restarTotalRonda(producto.precio, cantidad); // Restar del totalRonda al eliminar
        });
        carritoItem.appendChild(eliminarBtn);

        carritoContainer.appendChild(carritoItem);

        calcularTotalRonda(producto.precio, cantidad); // Calcular totalRonda al agregar
    }

    function calcularTotalRonda(precioProducto, cantidad) {
        totalRonda += precioProducto * cantidad;
    }

    function restarTotalRonda(precioProducto, cantidad) {
        totalRonda -= precioProducto * cantidad;
    }
</script>
