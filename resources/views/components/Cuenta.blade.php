<div class="cuenta">
    <h2>Resumen de la Cuenta</h2>
    @if (session('user'))
        <p>Nombre: {{ session('user')['first_name'] }} {{ session('user')['last_name'] }}</p>
        <div id="resumen-cuenta">
            <p>Cargando resumen de la cuenta...</p>
        </div>
        <p>Total de la cuenta: $<span id="total-cuenta">Cargando...</span></p>
        <script src="{{ secure_asset('js/cuenta.js') }}"></script>
    @else
        <p>No se encontró información del usuario.</p>
    @endif
</div>
