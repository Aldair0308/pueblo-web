<div id="carrito-plegado" class="carrito-container">
    <div class="carrito-content">
        <div class="carrito-total-info">
            <p id="carrito-total-plegado">MX$0.00</p>
            <span id="carrito-saved-info" class="carrito-saved"></span>
        </div>
        <button id="ver-carrito-btn" class="ver-carrito-btn">
            <span>Ver Carrito</span>
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
            <p>Total: MX$<span id="totalRonda">0.00</span></p>
            <button type="submit" form="ordenForm" class="enviar-orden-btn">Enviar Orden</button>
        </div>
    </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">



<script src="{{ secure_asset('js/Carro.js') }}"></script>

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
        setInterval(updateCarritoViews, 1800);

        // Inicializar la vista del carrito al cargar la página
        updateCarritoViews();

        document.getElementById("ver-carrito-btn").addEventListener("click", function() {
            document.getElementById("carrito-modal").style.display = "flex";
            document.body.classList.add("body-no-scroll");
        });

        document.getElementById("cerrar-carrito-btn").addEventListener("click", function() {
            document.getElementById("carrito-modal").style.display = "none";
            document.body.classList.remove("body-no-scroll");
        });

    });
</script>

<link rel="stylesheet" href="{{ secure_asset('css/plegado.css') }}">
<link rel="stylesheet" href="{{ secure_asset('css/desplegado.css') }}">
<link rel="stylesheet" href="{{ secure_asset('css/list-items.css') }}">
