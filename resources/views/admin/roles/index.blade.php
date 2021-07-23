@extends('layouts.master')

@section('content-header')

    @include('layouts.partials.contentHeader',$info =[
    'title' =>'Roles',
    'subtitle' => 'Administracion',
    'breadCrumbs' =>['users','index']
    ])
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="card mb-4 shadow-sm card-outline card-primary">
                    <div class="card-header ">
                        <h3 class="card-title mt-1">
                            Listado de roles
                        </h3>
                        @can('create', $roles->first())
                            <div class="card-tools">
                                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                    Crear Role
                                </a>
                            </div>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered" id="rolesTable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Identificador</th>
                                    <th>Nombre</th>
                                    <th>Permisos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->display_name }}</td>
                                        <td>{{ $role->permissions->pluck('display_name')->implode(', ') }}</td>
                                        <td>
                                            @can('update', $role)
                                                <a href="{{ route('admin.roles.edit', $role) }}"
                                                    class="btn btn-sm btn-success">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            @endcan

                                            @can('delete', $role)
                                                @if ($role->id !== 1)
                                                    <form method="POST" action="{{ route('admin.roles.destroy', $role) }}"
                                                        style="display:inline">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Estas seguro de querer eliminar este rol')">
                                                            <i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                @endif
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>


    <script>
        $(document).ready(function() {
            var table = $('#rolesTable').removeAttr('width').DataTable({
                pageLength: 25,
                lengthMenu: [
                    [25, 50, 100, -1],
                    [25, 50, 100, 'All']
                ],
                scrollY: "45vh",

                dom: '"<\'row\'<\'col-md-6\'B><\'col-md-6\'f>>" +\n' +
                    '"<\'row\'<\'col-sm-12\'tr>>" +\n' +
                    '"<\'row\'<\'col-sm-12 col-md-5\'i ><\'col-sm-12 col-md-7\'p>>"',

                buttons: {
                    dom: {
                        container: {
                            tag: 'div',
                            className: 'flexcontent'
                        },
                        buttonLiner: {
                            tag: null
                        }
                    },
                    buttons: [{
                        extend: 'pageLength',
                        titleAttr: 'Show Records',
                        className: 'btn selectTable btn-dark',
                        init: function(api, node, config) {
                            $(node).removeClass('btn-secondary buttons-html5')
                        },
                    }, ],
                },
            });
        });
    </script>
@endpush
