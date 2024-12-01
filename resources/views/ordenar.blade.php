<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordena tus productos</title>
    <link rel="stylesheet" href="{{ asset('css/home-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal-styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <h1>Ordena Fácilmente</h1>
            <p>Selecciona tus productos y envía tu pedido</p>
        </header>

        <!-- Contenedor de productos -->
        <div id="productosContainer" class="productos-container">
            <!-- Los productos se renderizan dinámicamente -->
        </div>

        <!-- Modal para personalizar el producto -->
        <div id="productModal" class="modal">
            <div class="modal-content">
                <button class="close-modal" onclick="toggleModal(false)">×</button>
                <div class="modal-header">
                    <h2 id="modalTitle">Título del Producto</h2>
                    <p id="modalPrice">MX$0.00</p>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Producto" class="modal-image">
                    <textarea id="modalDescription" placeholder="Escribe una descripción..." class="descripcion-input"></textarea>
                    <div class="quantity-controls">
                        <button onclick="updateQuantity(-1)">−</button>
                        <span id="quantity">1</span>
                        <button onclick="updateQuantity(1)">+</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="add-to-cart" onclick="addToCart()">Agregar al Carrito</button>
                </div>
            </div>
        </div>

        <!-- Componente Carrito (fijo al fondo) -->
        <div id="carritoWrapper">
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
        </div>
    </div>

    <script src="{{ asset('js/ordenar.js') }}"></script>
    <script src="{{ asset('js/modal-prod.js') }}"></script>
    <script src="{{ asset('js/carrito.js') }}"></script>
</body>

</html>
