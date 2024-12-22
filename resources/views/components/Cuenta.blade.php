<div class="cuenta">
    <div class="total-cuenta">
        <p><strong>Total de la cuenta:</strong> <span id="total-cuenta">Cargando...</span></p>
        <button id="open-modal">Consultar cuenta total</button>
    </div>

    <div id="cuenta-modal" class="modal">
        <div class="modal-content">
            <span id="close-modal" class="close">&times;</span>
            <h2>Resumen de la Cuenta</h2>
            @if (session('user'))
                <p><strong>Nombre:</strong> {{ session('user')['first_name'] }}</p>
                <div id="resumen-cuenta">
                    <p>Cargando resumen de la cuenta...</p>
                </div>
                <div class="total-cuenta">
                    <p><strong>Total de la cuenta:</strong> <span id="modal-total-cuenta">Cargando...</span></p>
                </div>
            @else
                <p>No se encontró información del usuario.</p>
            @endif
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('cuenta-modal');
        const openModalBtn = document.getElementById('open-modal');
        const closeModalBtn = document.getElementById('close-modal');
        const resumenCuentaElement = document.getElementById('resumen-cuenta');
        const totalCuentaElement = document.getElementById('total-cuenta');
        const modalTotalCuentaElement = document.getElementById('modal-total-cuenta');
        const totalCuentaWrapper = document.querySelector(
            '.total-cuenta'); // Wrapper para ocultar total y botón.

        openModalBtn.addEventListener('click', function() {
            modal.style.display = 'block';
            requestAnimationFrame(() => {
                modal.classList.remove('hide');
                modal.classList.add('show');
            });
        });

        const closeModal = () => {
            modal.classList.remove('show');
            modal.classList.add('hide');

            modal.addEventListener(
                'animationend',
                () => {
                    modal.style.display = 'none';
                }, {
                    once: true
                }
            );
        };

        closeModalBtn.addEventListener('click', closeModal);

        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        const formatTime12Hours = (timestamp) => {
            if (!timestamp) return "Hora no disponible";

            const date = new Date(timestamp);
            if (isNaN(date.getTime())) return "Hora no válida";

            let hours = date.getUTCHours(); // Usar getUTCHours para manejar el formato en Zulu Time
            const minutes = date.getUTCMinutes();
            const ampm = hours >= 12 ? "PM" : "AM";
            hours = hours % 12 || 12; // Convertir a formato de 12 horas
            return `${hours}:${minutes < 10 ? "0" : ""}${minutes} ${ampm}`;
        };

        const fetchRondas = async () => {
            try {
                const userName = encodeURIComponent(
                    "{{ session('user')['first_name'] }} {{ session('user')['last_name'] }}"
                );
                const response = await fetch(
                    `https://pueblo-nest-production-5afd.up.railway.app/api/v1/rondas/mesa/${userName}`
                );
                if (!response.ok) {
                    if (response.status === 404) {
                        totalCuentaWrapper.style.display = 'none'; // Ocultar total y botón.
                    }
                    throw new Error(`Error HTTP ${response.status}: ${await response.text()}`);
                }
                const data = await response.json();

                let totalCuenta = 0;
                const newHtml = data.map(ronda => {
                    totalCuenta += ronda.totalRonda;
                    return `
                <div class="ronda">
                    <div class="ronda-header">Mesa: ${ronda.numeroMesa} - ${formatTime12Hours(ronda.timestamp)}</div>
                    ${ronda.productos.map((producto, index) => `
                        <div class="ronda-producto">
                            (${ronda.cantidades[index]}) ${producto}
                        </div>
                        <div class="ronda-producto">
                            ${ronda.descripciones[index] || ''}
                        </div>
                    `).join('')}
                    <div><strong>Total de la ronda:</strong> $${ronda.totalRonda.toFixed(2)}</div>
                </div>
            `;
                }).join('');

                resumenCuentaElement.innerHTML = newHtml;
                totalCuentaElement.textContent = `$${totalCuenta.toFixed(2)}`;
                modalTotalCuentaElement.textContent = `$${totalCuenta.toFixed(2)}`;
                totalCuentaWrapper.style.display =
                    ''; // Mostrar total y botón si se cargan rondas correctamente.
            } catch (error) {
                console.error('Error al cargar las rondas:', error);
                resumenCuentaElement.innerHTML = '<p>Error al cargar el resumen de la cuenta.</p>';
            }
        };

        fetchRondas();
        setInterval(fetchRondas, 10000);
    });
</script>

<style>
    .cuenta {
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .total-cuenta {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-top: 20px;
    }

    #open-modal {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #open-modal:hover {
        background-color: #0056b3;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal.show {
        display: block;
        animation: slideIn 0.4s ease-out;
    }

    .modal.hide {
        animation: slideOut 0.4s ease-in;
        animation-fill-mode: forwards;
    }

    @keyframes slideIn {
        from {
            transform: translateY(100%);
        }

        to {
            transform: translateY(0);
        }
    }

    @keyframes slideOut {
        from {
            transform: translateY(0);
        }

        to {
            transform: translateY(100%);
        }
    }

    .modal-content {
        background-color: #f9f9f9;
        margin: 8% auto;
        /* Corrige el centrado vertical y horizontal */
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 80%;
        max-width: 600px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }


    .modal-content h2 {
        font-size: 24px;
        color: #333;
        text-align: center;
    }

    .modal-content p {
        font-size: 16px;
        color: #555;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: black;
    }

    #resumen-cuenta {
        margin: 10px 0;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .ronda {
        margin-bottom: 15px;
        padding: 10px;
        background-color: #f1f1f1;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .ronda-header {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .ronda-producto {
        margin-left: 15px;
        font-size: 14px;
        color: #666;
    }
</style>
