<!doctype html>
<html lang="en">
<head>
    <title>Reporte de Rondas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- Logo -->
        <img src="{{ secure_asset('images/logo.jpg') }}" alt="Company Logo" width="100px" height="100px">
    </header>
    <main>
        <div class="container mt-4">
            <div id="report" class="row">
                <!-- Las tarjetas se insertarán aquí -->
            </div>
        </div>
    </main>
    <footer>
        <!-- Footer content -->
        <div class="container mt-4">
            <p class="text-center">© {{ date('Y') }} Tu Empresa. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script>
        async function fetchAndProcessData() {
            try {
                // Fetch data from the API
                const response = await fetch('https://pueblo-nest-production.up.railway.app/api/v1/rondas');
                const rondas = await response.json();

                // Filter to get only the data from the last 7 days
                const sevenDaysAgo = new Date();
                sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);

                const filteredRondas = rondas.filter(ronda => {
                    const timestamp = new Date(ronda.timestamp);
                    return timestamp >= sevenDaysAgo;
                });

                // Group by date and then by product
                const groupedData = {};
                filteredRondas.forEach(ronda => {
                    const date = new Date(ronda.timestamp).toISOString().split('T')[0]; // Format date as YYYY-MM-DD

                    if (!groupedData[date]) {
                        groupedData[date] = [];
                    }

                    // Process each ronda to group products and sum quantities
                    const productsMap = {};
                    ronda.productos.forEach((producto, index) => {
                        const cantidad = parseInt(ronda.cantidades[index], 10);
                        if (!productsMap[producto]) {
                            productsMap[producto] = 0;
                        }
                        productsMap[producto] += cantidad;
                    });

                    // Add processed ronda to the grouped data
                    groupedData[date].push({
                        mesa: ronda.mesa,
                        numeroMesa: ronda.numeroMesa,
                        estado: ronda.estado,
                        totalRonda: ronda.totalRonda,
                        productos: productsMap
                    });
                });

                // Generate HTML for cards
                const reportContainer = document.getElementById('report');
                Object.keys(groupedData).forEach(date => {
                    const dateGroup = groupedData[date];
                    const dateFormatted = new Date(date).toLocaleDateString();

                    // Create a card for each date
                    let cardHtml = `<div class="col-md-12 mb-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>${dateFormatted}</h5>
                                            </div>
                                            <div class="card-body">`;

                    dateGroup.forEach(ronda => {
                        cardHtml += `<div class="mb-3">
                                        <h6>Mesa: ${ronda.mesa} - Número de Mesa: ${ronda.numeroMesa}</h6>
                                        <p>Estado: ${ronda.estado}</p>
                                        <p>Total: $${ronda.totalRonda}</p>
                                        <ul>`;

                        for (const [producto, cantidad] of Object.entries(ronda.productos)) {
                            cardHtml += `<li>${producto}: ${cantidad}</li>`;
                        }

                        cardHtml += `</ul></div>`;
                    });

                    cardHtml += `</div></div></div>`;

                    reportContainer.innerHTML += cardHtml;
                });

            } catch (error) {
                console.error('Error al procesar los datos:', error);
            }
        }

        // Fetch data when the page loads
        document.addEventListener('DOMContentLoaded', fetchAndProcessData);
    </script>
</body>
</html>
