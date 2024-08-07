
@extends('adminlte::page')


@section('title', 'Crear Producto')

@section('content_header')
    <h1>Crear Producto</h1>
@stop

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Create') }} Producto</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('productos.store') }}"  role="form" enctype="multipart/form-data">
                        @csrf

                        @include('producto.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
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
