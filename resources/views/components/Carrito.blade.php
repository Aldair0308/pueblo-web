<div id="carrito-plegado" class="carrito-container">
    <div class="carrito-content">
        <div class="carrito-total-info">
            <p id="carrito-total-plegado">MX$0.00</p>
            <span id="carrito-saved-info" class="carrito-saved"></span>
        </div>
        <button id="ver-carrito-btn" class="ver-carrito-btn">
            <span>View Cart</span>
            <div class="carrito-badge" style="display: none;">
                <span id="carrito-count">0</span>
            </div>
        </button>
    </div>
</div>

<div id="carrito-modal" class="modal-carrito">
    <div class="modal-carrito-content">
        <button id="cerrar-carrito-btn" class="cerrar-carrito-btn">×</button>
        <h4>Carrito</h4>
        <div id="carritoItems" class="carrito-items">
            <!-- Aquí se agregarán los productos seleccionados dinámicamente -->
        </div>
        <div class="carrito-total">
            <p>Total: $<span id="totalRonda">0.00</span></p>
        </div>
        <button type="submit" form="ordenForm" class="enviar-orden-btn">Enviar Orden</button>
    </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<script src="{{ asset('js/Carro.js') }}"></script>

<style>
    /* Carrito plegado */
    .carrito-container {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        border-top: 3px solid #e60000;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        box-shadow: 0px -2px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .carrito-total-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .carrito-total-info p {
        font-size: 1.2em;
        font-weight: bold;
        margin: 0;
    }

    .carrito-saved {
        font-size: 0.9em;
        color: #666;
    }

    .ver-carrito-btn {
        background-color: #ff6600;
        color: #fff;
        border: none;
        padding: 10px 15px;
        font-size: 1em;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: background-color 0.3s ease;
    }

    .ver-carrito-btn:hover {
        background-color: #e65c00;
    }

    .carrito-badge {
        background-color: #fff;
        color: #e60000;
        border: 2px solid #e60000;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
    }

    /* Modal del carrito */
    .modal-carrito {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1001;
        justify-content: center;
        align-items: center;
    }

    .modal-carrito-content {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        width: 90%;
        max-width: 500px;
        max-height: 90%;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .cerrar-carrito-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        color: #e60000;
        font-size: 1.5em;
        cursor: pointer;
    }

    /* Carrito plegado */
    .carrito-container {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        border-top: 3px solid #e60000;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        box-shadow: 0px -2px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .ver-carrito-btn {
        background-color: #ff6600;
        color: #fff;
        border: none;
        padding: 10px 15px;
        font-size: 1em;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .ver-carrito-btn:hover {
        background-color: #e65c00;
    }

    /* Modal del carrito */
    .modal-carrito {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1001;
        justify-content: center;
        align-items: center;
    }

    .modal-carrito-content {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        width: 90%;
        max-width: 500px;
        max-height: 90%;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .cerrar-carrito-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        color: #e60000;
        font-size: 1.5em;
        cursor: pointer;
    }

    /* Estilos del carrito (idénticos al diseño anterior) */
    .carrito-items {
        flex-grow: 1;
        overflow-y: auto;
        margin: 15px 0;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
    }

    .carrito-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .product-info {
        flex: 1;
        margin-right: 15px;
    }

    .product-name {
        font-weight: bold;
    }

    .product-description {
        font-size: 0.9em;
        color: #666;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .cantidad-btn {
        background-color: #e60000;
        color: white;
        border: none;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 5px;
        font-size: 1.2em;
        cursor: pointer;
    }

    .cantidad-btn:hover {
        background-color: #bf0000;
    }

    .cantidad-text {
        font-weight: bold;
        font-size: 1em;
        margin: 0 10px;
    }

    .product-price {
        font-weight: bold;
        font-size: 1.1em;
    }

    .eliminar-btn {
        background: none;
        border: none;
        color: #e74c3c;
        font-size: 1.2em;
        cursor: pointer;
        margin-left: 10px;
    }

    .eliminar-btn:hover {
        color: #bf0000;
    }

    .enviar-orden-btn {
        background-color: #29a64d;
        color: #fff;
        border: none;
        padding: 15px;
        font-size: 1.2em;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }

    .enviar-orden-btn:hover {
        background-color: #23923c;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const carritoPlegado = document.getElementById("carrito-plegado");
        const verCarritoBtn = document.getElementById("ver-carrito-btn");
        const carritoModal = document.getElementById("carrito-modal");
        const cerrarCarritoBtn = document.getElementById("cerrar-carrito-btn");
        const carritoTotalPlegado = document.getElementById("carrito-total-plegado");
        const totalRonda = document.getElementById("totalRonda");
        const carritoCount = document.getElementById("carrito-count");
        const carritoBadge = document.querySelector(".carrito-badge");

        // Función para calcular el total y el número de ítems en el carrito
        function calculateCartTotals() {
            let total = 0;
            let items = 0;

            // Iterar sobre los ítems del carrito para sumar precios y cantidades
            document.querySelectorAll(".carrito-item").forEach((item) => {
                const precio = parseFloat(item.dataset.precio) || 0;
                const cantidad = parseInt(item.dataset.cantidad) || 0;
                total += precio * cantidad;
                items += cantidad;
            });

            return {
                total,
                items,
            };
        }

        // Función para actualizar el carrito plegado y el desplegado al mismo tiempo
        function updateCarritoViews() {
            const {
                total,
                items
            } = calculateCartTotals();

            if (total === 0 || items === 0) {
                // Ocultar carrito plegado y modal si no hay ítems
                carritoPlegado.style.display = "none";
                carritoModal.style.display = "none";
            } else {
                // Mostrar carrito plegado y actualizar los valores
                carritoPlegado.style.display = "flex";

                // Actualizar el total en el carrito desplegado
                totalRonda.textContent = total.toFixed(2);

                // Actualizar el total en el carrito plegado
                carritoTotalPlegado.textContent = `MX$${total.toFixed(2)}`;

                // Actualizar el contador de ítems y mostrarlo solo si hay ítems
                carritoCount.textContent = items;
                carritoBadge.style.display = "flex";
            }
        }

        // Mostrar el modal del carrito
        verCarritoBtn.addEventListener("click", function() {
            carritoModal.style.display = "flex";
            updateCarritoViews(); // Asegurar que las vistas estén sincronizadas al abrir
        });

        // Cerrar el modal del carrito
        cerrarCarritoBtn.addEventListener("click", function() {
            carritoModal.style.display = "none";
        });

        // Sincronizar la información del carrito cada 2 segundos
        setInterval(updateCarritoViews, 2000);

        // Inicializar la vista del carrito al cargar la página
        updateCarritoViews();
    });
</script>
