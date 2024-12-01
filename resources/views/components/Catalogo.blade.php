<!-- resources/views/components/catalogo.blade.php -->
<div id="revista" class="revista">
    <div id="flipbook" class="flipbook">
        <!-- Página 1 -->
        <div class="pagina">
            <h2>Portada de la Revista</h2>
            <img src="{{ asset('images/logo.jpg') }}" alt="Portada de la Revista" class="imagen-portada">
        </div>

        <!-- Página 2 -->
        <div class="pagina">
            <h2>Artículo 1</h2>
            <p>Contenido del artículo 1...</p>
        </div>

        <!-- Página 3 -->
        <div class="pagina">
            <h2>Artículo 2</h2>
            <p>Contenido del artículo 2...</p>
        </div>

        <!-- Puedes agregar más páginas aquí -->
    </div>
</div>

<!-- Estilos específicos para el flipbook -->
<style scoped>
    .revista {
        width: 100%;
        height: 500px;
        margin: 0 auto;
        overflow: hidden;
    }

    .flipbook {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .pagina {
        background: #fff;
        padding: 20px;
        height: 100%;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        /* Apunta al clic */
    }

    .pagina img {
        max-width: 100%;
        max-height: 400px;
        object-fit: contain;
        border-radius: 8px;
    }

    .pagina h2 {
        text-align: center;
        font-size: 1.5rem;
        color: #333;
    }

    .pagina p {
        text-align: justify;
        font-size: 1rem;
        color: #555;
    }

    /* Estilos de la navegación con el cursor */
    .pagina:hover {
        opacity: 0.9;
        background-color: #f1f1f1;
    }
</style>

<!-- Cargar la librería Turn.js de forma correcta -->
<script src="{{ secure_asset('https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.0/turn.min.js') }}></script>
<script src="{{ secure_asset('vendor/jquery/jquery.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const flipbook = document.getElementById('flipbook');

        // Inicializar Turn.js en el contenedor del flipbook
        $(flipbook).turn({
            width: '100%',
            height: '500px',
            autoCenter: true,
            display: 'single', // Modo de una sola página (por el lado derecho)
            duration: 1000, // Duración de la animación de pasar página
            when: {
                turning: function(event, page, view) {
                    console.log('Página actual: ' +
                        page); // Puedes desactivar este log si no lo necesitas
                }
            }
        });

        // Habilitar interactividad para pasar páginas al hacer clic en la página
        $(".pagina").on("click", function() {
            var currentPage = $(flipbook).turn('page');
            var totalPages = $(flipbook).turn('pages');
            if (currentPage < totalPages) {
                $(flipbook).turn('next'); // Si no es la última página, pasa a la siguiente
            } else {
                $(flipbook).turn('page', 1); // Si llegamos al final, regresar a la primera página
            }
        });
    });
</script>
