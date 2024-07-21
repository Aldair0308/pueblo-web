@extends('adminlte::page')


@section('title', 'Mostrar personal')

@section('content_header')
    <h1>Mostrar personal</h1>
@stop

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} User</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">
                    
                    <div class="form-group mb-2 mb20">
                        <strong>Name:</strong>
                        {{ $user->name }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Updated At:</strong>
                        {{ $user->updated_at }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Rol:</strong>
                        {{ $user->role }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
