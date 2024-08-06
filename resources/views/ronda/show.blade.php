{{-- @extends('adminlte::page')

@section('title', 'Mostrar ronda')

@section('content_header')
    <h1>Mostrar ronda</h1>
@stop

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Ronda</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('rondas.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Mesa:</strong>
                        {{ $ronda->mesa }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Numeromesa:</strong>
                        {{ $ronda->numeroMesa }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Estado:</strong>
                        {{ $ronda->estado }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Mesero:</strong>
                        {{ $ronda->mesero }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Totalronda:</strong>
                        {{ $ronda->totalRonda }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Timestamp:</strong>
                        {{ $ronda->timestamp }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Deletedat:</strong>
                        {{ $ronda->deletedAt }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Productos:</strong>
                        {{ $ronda->productos }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Cantidades:</strong>
                        {{ $ronda->cantidades }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Descripciones:</strong>
                        {{ $ronda->descripciones }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@stop --}}

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
