document.addEventListener('DOMContentLoaded', function () {
    const productosContainer = document.getElementById('productosContainer');

    // Función para renderizar los productos
    function renderizarProductos(productos) {
        productosContainer.innerHTML = ''; // Limpiar el contenedor antes de renderizar
        productos.forEach(producto => {
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

            const agregarBtn = document.createElement('button');
            agregarBtn.textContent = 'Agregar al Carrito';
            agregarBtn.classList.add('cantidad-btn', 'agregar-btn');
            agregarBtn.addEventListener('click', function () {
                toggleModal(true, producto); // Abrir modal para personalizar el producto
            });

            card.appendChild(agregarBtn);
            productosContainer.appendChild(card);
        });
    }

    // Fetch para obtener los productos
    fetch('https://pueblo-nest-production-5afd.up.railway.app/api/v1/productos')
        .then(response => response.json())
        .then(data => {
            renderizarProductos(data); // Renderiza los productos
        })
        .catch(error => {
            console.error('Error al obtener los productos:', error);
            alert('Hubo un error al obtener los productos');
        });
});
