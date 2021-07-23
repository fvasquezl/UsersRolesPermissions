@extends('layouts.master')

@section('content-header')

    @include('layouts.partials.contentHeader',$info =[
    'title' =>'Usuarios',
    'subtitle' => 'Administracion',
    'breadCrumbs' =>['users','index']
    ])
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12 my-3">
                <div class="card mb-4 shadow-sm card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title mt-1">
                            Listado de Usuarios
                        </h3>
                        @can('create', $users->first())
                            <div class="card-tools">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                    Crear Usuario
                                </a>
                            </div>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered" id=usersTable>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Fecha de Creacion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                                        <td>{{ $user->created_at->toFormattedDateString() }}</td>

                                        <td class="text-center">
                                            @can('view', $user)
                                                <a href="{{ route('admin.users.show', $user) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endcan

                                            @can('update', $user)
                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                    class="btn btn-sm btn-success">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            @endcan

                                            @can('delete', $user)
                                                {{-- <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                    style="display:inline">
                                                    @csrf @method('DELETE') --}}
                                                {{-- <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Estas seguro de querer eliminar este usuario')">
                                                        <i class="fas fa-trash-alt"></i></button> --}}
                                                {{-- </form> --}}

                                                <button class="btn btn-sm btn-danger delete-btn">
                                                    <i class="fas fa-trash-alt"></i></button>
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
    <script src="{{ asset('js/common.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#usersTable').DataTable({
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
                    }],
                },
            });
        });

        $('.delete-btn').on('click', function(e) {
            e.stopPropagation();
            let id = $(this).closest('tr').attr('id');
            console.log($(this).rowId);
            let url = "{{ route('admin.users.destroy', ':id') }}";
            url = url.replace(':id', id);
            deleteInfo(url);

            // window.location.href = "{{ route('admin.users.index') }}";
        });
    </script>
@endpush
