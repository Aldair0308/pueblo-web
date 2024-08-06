@extends('adminlte::page')


@section('title', 'Panel de Control')

@section('content_header')
    <h1>Panel de Control</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <a href="{{ route('rondas.pdf') }}" target="_blank">PDF de rondas</a>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
