<!-- ordenarProductos.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordena tus productos</title>
    <link rel="stylesheet" href="{{ asset('css/home-styles.css')}}">
</head>
<body>
    <div class="containerSet">
        <div class="card-ordenar">
            <h3>Ordena tus productos aquí</h3>
            <form id="ordenForm">
                <!-- Campos ocultos para el nombre del usuario y mesero -->
                <input type="hidden" id="mesa" name="mesa" value="{{ Auth::user()->name }}">
                <input type="hidden" id="mesero" name="mesero" value="{{ Auth::user()->name }}">
                
               <!-- Número de Mesa obtenido de la ruta (readonly) -->
               @php
               $numeroMesa = isset($numeroMesa) ? $numeroMesa : ''; // Obtener el número de mesa de la variable pasada desde el controlador
                @endphp
                <label for="numeroMesa">Número de Mesa:</label>
                <input type="number" id="numeroMesa" name="numeroMesa" value="{{ $numeroMesa }}" readonly><br><br>

                <!-- Incluir el componente Carrito -->
                <x-Carrito/>

                <!-- Campo oculto para el estado -->
                <input type="hidden" id="estado" name="estado" value="por_preparar">

                <button type="submit">Enviar Orden</button>
            </form>
        </div>

        <div id="productosContainer" class="productos-container">
            <!-- Aquí se renderizarán los productos -->
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productosContainer = document.getElementById('productosContainer');
            let totalRonda = 0; // Variable para calcular el total de la ronda

            fetch('https://pueblo-nest-production.up.railway.app/api/v1/productos')
                .then(response => response.json())
                .then(data => {
                    productosContainer.innerHTML = ''; // Limpiar el contenedor antes de renderizar

                    // Iterar sobre los productos y crear las cards
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

                        // Campo de descripción
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
                            const descripcion = descripcionInput.value.trim(); // Obtener la descripción

                            if (cantidad > 0) {
                                agregarAlCarrito(producto, cantidad, descripcion);
                                calcularTotalRonda(producto.precio, cantidad); // Calcular totalRonda
                                cantidadInput.value = '0'; // Reiniciar cantidad a cero después de agregar al carrito
                                descripcionInput.value = ''; // Limpiar campo de descripción
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

            // Event listener para enviar la orden
            document.getElementById('ordenForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar que el formulario se envíe de manera tradicional

                const formData = new FormData(this); // Obtener datos del formulario

                // Obtener productos del carrito
                const carritoItems = carritoContainer.getElementsByClassName('carrito-item');
                const productos = [];
                const cantidades = [];
                const descripciones = [];

                for (let item of carritoItems) {
                    const nombreProducto = item.querySelector('p:first-child').textContent.split(': ')[1];
                    const cantidad = parseInt(item.querySelector('p:nth-child(2)').textContent.split(': ')[1]);
                    const descripcion = item.querySelector('p:nth-child(3)');
                    
                    productos.push(nombreProducto);
                    cantidades.push(cantidad);
                    descripciones.push(descripcion ? descripcion.textContent.split(': ')[1] : ''); // Si no hay descripción, enviar cadena vacía
                }

                // Construir el objeto JSON según la estructura requerida
                const orden = {
                    mesa: formData.get('mesa'),
                    numeroMesa: parseInt(formData.get('numeroMesa')),
                    estado: formData.get('estado'),
                    mesero: formData.get('mesero'),
                    productos: productos,
                    cantidades: cantidades,
                    descripciones: descripciones,
                    totalRonda: totalRonda
                };

                // Añadir el estado manualmente
                orden.estado = 'por_preparar';

                // Enviar la orden a la API
                fetch('https://pueblo-nest-production.up.railway.app/api/v1/rondas', {
                    method: 'POST',
                    body: JSON.stringify(orden),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Respuesta:', data);
                    alert('Orden enviada correctamente');
                    // Limpiar el carrito después de enviar la orden
                    carritoContainer.innerHTML = '';
                    totalRonda = 0; // Reiniciar totalRonda después de enviar la orden
                })
                .catch(error => {
                    console.error('Error al enviar la orden:', error);
                    alert('Hubo un error al enviar la orden');
                });
            });
        });
    </script>
</body>
</html>
