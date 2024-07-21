


@extends('adminlte::page')


@section('title', 'Actualizar')

@section('content_header')
    <h1>Actualizar Producto</h1>
@stop

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Producto</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('productos.update', $producto->id) }}"  role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('producto.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop