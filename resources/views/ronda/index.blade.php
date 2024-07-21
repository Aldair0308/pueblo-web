

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
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    
                                    <th>Mesa</th>
                                    <th>Numeromesa</th>
                                    <th>Estado</th>
                                    <th>Mesero</th>
                                    <th>Totalronda</th>
                                    <th>Timestamp</th>
                                    <th>Deletedat</th>
                                    <th>Productos</th>
                                    <th>Cantidades</th>
                                    <th>Descripciones</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rondas as $ronda)
                                    <tr>
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

                                        <td>
                                            <form action="{{ route('rondas.destroy',$ronda->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('rondas.show',$ronda->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('rondas.edit',$ronda->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $rondas->links() !!}
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
