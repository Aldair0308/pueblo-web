<div class="cuenta">
    <h2>Resumen de la Cuenta</h2>
    @if (session('user'))
        <p><strong>Nombre:</strong> {{ session('user')['first_name'] }} {{ session('user')['last_name'] }}</p>
        <div id="resumen-cuenta">
            <p>Cargando resumen de la cuenta...</p>
        </div>
        <div class="total-cuenta">
            <p><strong>Total de la cuenta:</strong> $<span id="total-cuenta">Cargando...</span></p>
        </div>
        <script src="{{ secure_asset('js/cuenta.js') }}"></script>
    @else
        <p>No se encontró información del usuario.</p>
    @endif
</div>


<style>
    .cuenta {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }

    .cuenta h2 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #333;
        text-align: center;
    }

    .cuenta p {
        font-size: 16px;
        color: #555;
        margin-bottom: 10px;
    }

    #resumen-cuenta {
        margin: 10px 0;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    #resumen-cuenta ul {
        list-style: none;
        padding: 0;
    }

    #resumen-cuenta li {
        padding: 5px 0;
        border-bottom: 1px solid #eee;
    }

    #resumen-cuenta li:last-child {
        border-bottom: none;
    }

    .total-cuenta {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        text-align: right;
        margin-top: 20px;
    }
</style>
