@extends('layouts.app')

@section('template_title')
    {{ $mesa->name ?? __('Show') . " " . __('Mesa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Mesa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('mesas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Nomesa:</strong>
                            {{ $mesa->noMesa }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Cliente:</strong>
                            {{ $mesa->cliente }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Estado:</strong>
                            {{ $mesa->estado }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Totalcuenta:</strong>
                            {{ $mesa->totalCuenta }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Horapago:</strong>
                            {{ $mesa->horaPago }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
