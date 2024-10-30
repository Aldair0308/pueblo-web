@extends('adminlte::page')


@section('title', 'Panel de Control')

@section('content_header')
    <h1>Panel de Control</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <a class="btn btn-primary" href="{{ route('meseros.pdf') }}" target="_blank">Meseros</a>
    <a class="btn btn-success" href="{{ route('rondas.pdf.descargas') }}" target="_blank">Descargar el PDF</a>
    <a class="btn btn-primary" href="{{ route('rondas.pdf') }}" target="_blank">PDF de rondas</a>
    <a class="btn btn-success" href="{{ route('meseros.pdf.descargas') }}" target="_blank">Descargar el PDF Por mesero</a>
@stop


@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ secure_asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/styles-home.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/styles-crud.css') }}">
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
@stop
