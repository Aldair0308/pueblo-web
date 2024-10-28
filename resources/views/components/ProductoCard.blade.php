<!-- ProductoCard.blade.php -->
<div class="card-producto">
    <img src="{{ $producto['foto'] }}" alt="{{ $producto['nombre'] }}">
    <h4>{{ $producto['nombre'] }}</h4>
    <p>Precio: {{ $producto['precio'] }}</p>

    <textarea placeholder="Escribe una descripción..." class="descripcion-input"></textarea>

    <div class="cantidad-container">
        <label>Cantidad:</label>
        <input type="number" class="cantidad-input" value="0" min="0">
        <button class="cantidad-btn">+</button>
        <button class="cantidad-btn">-</button>
        <button class="cantidad-btn agregar-btn">Agregar al Carrito</button>
    </div>
</div>

<<script>
    // JavaScript para manejar la interacción de la tarjeta de producto
    document.addEventListener('DOMContentLoaded', function() {
        const cardElement = document.currentScript.closest('.card-producto');

        fetch('https://pueblo-nest-production-5afd.up.railway.app/api/v1/productos')
            .then(response => response.json())
            .then(data => {
                // Iterar sobre los productos y crear las cards
                data.forEach(producto => {
                    if (producto.id ===
                        {{ $producto['id'] }}) { // Asegurar que el producto coincida
                        const imagen = document.createElement('img');
                        imagen.src = producto.foto;
                        imagen.alt = producto.nombre;
                        cardElement.appendChild(imagen);

                        const nombre = document.createElement('h4');
                        nombre.textContent = producto.nombre;
                        cardElement.appendChild(nombre);

                        const precio = document.createElement('p');
                        precio.textContent = `Precio: ${producto.precio}`;
                        cardElement.appendChild(precio);

                        // Campo de descripción
                        const descripcionInput = document.createElement('textarea');
                        descripcionInput.placeholder = 'Escribe una descripción...';
                        descripcionInput.classList.add('descripcion-input');
                        cardElement.appendChild(descripcionInput);

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

                        cardElement.appendChild(cantidadContainer);

                        // Event listener para incrementar cantidad
                        incrementBtn.addEventListener('click', function() {
                            let currentValue = parseInt(cantidadInput.value);
                            cantidadInput.value = currentValue + 1;
                        });

                        // Event listener para decrementar cantidad
                        decrementBtn.addEventListener('click', function() {
                            let currentValue = parseInt(cantidadInput.value);
                            if (currentValue > 0) {
                                cantidadInput.value = currentValue - 1;
                            }
                        });

                        // Event listener para agregar al carrito
                        agregarBtn.addEventListener('click', function() {
                            const cantidad = parseInt(cantidadInput.value);
                            const descripcion = descripcionInput.value
                        .trim(); // Obtener la descripción

                            if (cantidad > 0) {
                                agregarAlCarrito(producto, cantidad, descripcion);
                                calcularTotalRonda(producto.precio,
                                cantidad); // Calcular totalRonda
                                cantidadInput.value =
                                '0'; // Reiniciar cantidad a cero después de agregar al carrito
                                descripcionInput.value = ''; // Limpiar campo de descripción
                            } else {
                                alert('Selecciona al menos una unidad del producto.');
                            }
                        });
                    }
                });
            })
            .catch(error => {
                console.error('Error al obtener los productos:', error);
                alert('Hubo un error al obtener los productos');
            });
    });
</script>
