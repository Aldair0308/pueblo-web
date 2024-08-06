<!doctype html>
<html lang="es">
<head>
    <title>{{ $title }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        .table-container {
            margin: 0 auto;
            width: 95%;
            max-width: 1000px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border: 1px solid green; /* Borde verde */
            margin-bottom: 30px; /* Espaciado entre secciones */
        }
        .table {
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 30px;
        }
        .table thead th {
            background-color: #28a745; /* Verde */
            color: white;
            text-align: center;
            padding: 12px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
        .table td, .table th {
            padding: 12px;
            text-align: center;
            border: 1px solid #dee2e6;
        }
        .table td {
            background-color: #ffffff;
        }
        .table tfoot td {
            font-weight: bold;
        }
        .card-header {
            background-color: #343a40;
            color: white;
            border-bottom: 1px solid #dee2e6;
            padding: 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .card-body {
            padding: 20px;
        }
        .no-records {
            text-align: center;
            font-style: italic;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <!-- Logo -->
        <img src="{{ secure_asset('images/logo.jpg') }}" alt="Logo de la empresa" width="100px" height="100px" style="display: block; margin: 20px auto;">
    </header>
    <main>
        <div class="container">
            <h2 class="text-center mb-4">{{ $title }}</h2>
            @foreach ($groupedData as $date => $data)
                <div class="table-container">
                    <h4 class="text-center mb-4">{{ \Carbon\Carbon::parse($date)->locale('es')->isoFormat('D MMMM YYYY') }}</h4>
                    @if(count($data['productos']) > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Día</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['productos'] as $producto => $cantidad)
                                    <tr>
                                        <td>{{ $producto }}</td>
                                        <td>{{ $cantidad }}</td>
                                        <td>{{ \Carbon\Carbon::parse($date)->locale('es')->isoFormat('D MMMM YYYY') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="no-records">No hay registros para este día.</p>
                    @endif
                </div>
            @endforeach
        </div>
    </main>
    <footer class="footer">
        <p>© {{ date('Y') }} Tu Empresa. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
