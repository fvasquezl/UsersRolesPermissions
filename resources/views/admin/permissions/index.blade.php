@extends('layouts.master')

@section('content-header')
    @include('layouts.partials.contentHeader',$info =[
    'title' =>'Permisos',
    'subtitle' => 'Administracion',
    'breadCrumbs' =>['permissions','index']
    ])
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="card mb-4 shadow-sm card-outline card-primary">
                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered" id="permissionsTable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Identificador</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->display_name }}</td>
                                        <td class="text-center">
                                            @can('update', $permission)
                                                <a href="{{ route('admin.permissions.edit', $permission) }}"
                                                    class="btn btn-sm btn-success">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
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
            var table = $('#permissionsTable').removeAttr('width').DataTable({
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
                        className: 'btn selectTable btn-primary',
                    }],
                },
            });
        });
    </script>
@endpush