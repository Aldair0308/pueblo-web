<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordena tus productos</title>
    <link rel="stylesheet" href="{{ secure_asset('css/home-styles.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/modal-styles.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/carrito.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <h1>Bienvenido {{ $firstName }}</h1>
            <p>Selecciona tus productos realiza tu pedido para la mesa {{ $numeroMesa }}.</p>
        </header>

        <!-- Información del pedido -->
        <div class="order-info">
            <h3 class="order-title">Tu pedido</h3>
            <form id="ordenForm" class="order-form">
                <!-- Inputs ocultos para la mesa y mesero -->
                <input type="hidden" id="mesa" name="mesa" value="{{ $firstName }} {{ $lastName }}">
                <input type="hidden" id="mesero" name="mesero" value="{{ $firstName }} {{ $lastName }}">

                <!-- Número de Mesa obtenido de la ruta -->
                <label for="numeroMesa">Mesa:</label>
                <input type="number" id="numeroMesa" name="numeroMesa" value="{{ $numeroMesa ?? '' }}" readonly>
            </form>
        </div>

        <!-- Contenedor de productos -->
        <div id="productosContainer" class="productos-container">
            <!-- Los productos se renderizan dinámicamente -->
        </div>

        <div id="productModal" class="modal">
            <div class="modal-content">
                <button class="close-modal" onclick="toggleModal(false)">×</button>
                <div class="modal-header">
                    <h2 id="modalTitle">Producto</h2>
                    <p id="modalPrice">MX$0.00</p>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Producto" class="modal-image">
                    <textarea id="modalDescription" placeholder="Escribe una descripción..." class="descripcion-input"></textarea>

                    <!-- Contenedor de opciones de extras -->
                    <div id="escarchado-title" class="options-container">
                        <div class="title-options">
                            <h3>Escarchado</h3>
                            <p>Elige uno</p>
                        </div>
                        <div id="extrasContainer"></div>
                    </div>

                    <!-- Contenedor de opciones de personalización -->
                    <div id="personalizar" class="options-container">
                        <div class="title-options">
                            <h3>Personalizar</h3>
                            <p>Selecciona tus preferencias</p>
                        </div>
                        <div id="customizationContainer"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="quantity-controls">
                        <button onclick="updateQuantity(-1)">−</button>
                        <span id="quantity">1</span>
                        <button onclick="updateQuantity(1)" style="background-color: rgb(80, 205, 80)">+</button>
                    </div>
                    <button class="add-to-cart" onclick="addToCart()">Agregar al Carrito</button>
                </div>
            </div>
        </div>


    </div>





    <!-- Componente Carrito -->
    <div id="carritoWrapper">
        <x-Carrito />
    </div>
    </div>
    <script src="{{ secure_asset('js/modal-functions.js') }}" type="module"></script>
    <script src="{{ secure_asset('js/modal-prod.js') }}" type="module"></script>
    <script src="{{ secure_asset('js/carrito.js') }}"></script>
    <script src="{{ secure_asset('js/ordenar.js') }}"></script>
    {{-- <script src="{{ secure_asset('js/AuthGoogle.js') }}"></script> --}}

</body>

</html>
