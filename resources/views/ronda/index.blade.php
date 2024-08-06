@extends('adminlte::page')

@section('title', 'Rondas')

@section('content_header')
    <h1>Rondas</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Ronda') }}
                        </span>
                        <div class="float-right">
                            <a href="{{ route('rondas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                {{ __('Create New') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="rondas-table">
                            <thead class="thead">
                                <tr>
                                    <th>Acciones</th>
                                    <th>No</th>
                                    <th>Mesa</th>
                                    <th>Número Mesa</th>
                                    <th>Estado</th>
                                    <th>Mesero</th>
                                    <th>Total Ronda</th>
                                    <th>Timestamp</th>
                                    <th>Deleted At</th>
                                    <th>Productos</th>
                                    <th>Cantidades</th>
                                    <th>Descripciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rondas as $ronda)
                                    <tr>
                                        <td>
                                            <form action="{{ route('rondas.destroy', $ronda->id) }}" method="POST" class="delete-form">
                                                <a class="btn btn-sm btn-primary" href="{{ route('rondas.show', $ronda->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('rondas.edit', $ronda->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $ronda->mesa }}</td>
                                        <td>{{ $ronda->numeroMesa }}</td>
                                        <td>{{ $ronda->estado }}</td>
                                        <td>{{ $ronda->mesero }}</td>
                                        <td>{{ $ronda->totalRonda }}</td>
                                        <td>{{ $ronda->timestamp }}</td>
                                        <td>{{ $ronda->deletedAt }}</td>
                                        <td>{{ $ronda->productos }}</td>
                                        <td>{{ $ronda->cantidades }}</td>
                                        <td>{{ $ronda->descripciones }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
    <script src="{{ secure_asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#rondas-table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
                    "info": "_START_ / _END_ de un total de _TOTAL_",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron resultados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": activar para ordenar la columna de manera ascendente",
                        "sortDescending": ": activar para ordenar la columna de manera descendente"
                    }
                }
            });

            $('.delete-form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission
                var form = this;

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás recuperar este registro!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form if confirmed
                    }
                });
            });
        });
    </script>
@stop
