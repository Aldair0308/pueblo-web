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
                                            <form action="{{ route('rondas.destroy', $ronda->id) }}" method="POST">
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
    {{-- Estilos de DataTables desde CDN --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    
    
    {{-- Estilos adicionales --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/overlayScrollbars/1.13.1/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/your-custom-styles@latest/styles-home.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/your-custom-styles@latest/styles-crud.css">
@stop

@section('js')
    <!-- jQuery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- OverlayScrollbars -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/overlayScrollbars/1.13.1/js/jquery.overlayScrollbars.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/overlayScrollbars@1.13.1/js/jquery.overlayScrollbars.min.js"></script>
    
    <!-- AdminLTE -->
    <script src="//cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    
    
    <!-- Inicialización de DataTables -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
        $(document).ready(function() {
            $('#services-table').DataTable({
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
            
            @if ($message = Session::get('success'))
                Swal.fire({
                    title: '¡Éxito!',
                    text: '{{ $message }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

    <!-- Inicialización de SweetAlert2 -->
    <script>
        @if ($message = Session::get('success'))
            Swal.fire({
                title: '¡Éxito!',
                text: '{{ $message }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    </script>

    <!-- Inicialización de AdminLTE -->
    <script>
        $(document).ready(function () {
            if ($.AdminLTE) {
                $.AdminLTE.options.sidebarSlimScroll = true;
                $.AdminLTE.options.sidebarPushMenu = true;
                $.AdminLTE.options.expandOnHover = false;
                $.AdminLTE.options.sidebarExpandOnHover = false;
                $.AdminLTE.init();
            } else {
                console.error('AdminLTE no está disponible.');
            }
        });
    </script>
@stop

