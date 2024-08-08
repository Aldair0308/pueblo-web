<!-- resources/views/home.blade.php -->

@extends('adminlte::page')

@section('title', 'Casa')

@section('content_header')
<head>
    <title>Casa</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{ secure_asset('css/styles-home.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/styles-crud.css') }}">
@stop

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <div id="admin-content" class="d-none">
                            <p>Bienvenido, Aldair.</p>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Ir al panel de administrador</a>
                        </div>
                        <div id="user-content" class="d-none">
                            <p>Bienvenido, usuario.</p>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Ir al panel de usuario</a>
                        </div>
                        <div id="guest-content">
                            <p>Bienvenido, invitado.</p>
                            <a href="{{ route('guest.dashboard') }}" class="btn btn-light">Ir al panel de invitado</a>
                        </div>
                        <a href="{{ route('mesas.index') }}" class="btn btn-success">Ir a Mesas</a>
                        <button id="logout-button" class="btn btn-danger">Cerrar Sesión</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ secure_asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
@stop

@section('js')
    <x-Token />
    <script src="{{ secure_asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"
    ></script>

    <!-- jQuery (required for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Obtener el rol del usuario desde el almacenamiento local
            var userRole = localStorage.getItem('userRole');

            // Mostrar contenido basado en el rol del usuario
            if (userRole === 'barra') {
                $('#admin-content').removeClass('d-none');
            } else if (userRole === 'user') {
                $('#user-content').removeClass('d-none');
            } else {
                $('#guest-content').removeClass('d-none');
            }
        });
    </script>
@stop
