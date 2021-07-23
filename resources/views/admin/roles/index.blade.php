@extends('layouts.master')

@section('content-header')

    @include('layouts.partials.contentHeader',$info =[
    'title' =>'Roles',
    'subtitle' => 'Administration',
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
                            Roles List
                        </h3>
                        @can('create', new Spatie\Permission\Models\Role())
                            <div class="card-tools">
                                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                                    <i class="fa fa-user-secret"></i>
                                    Create Role
                                </a>
                            </div>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered" id="rolesTable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Identifier</th>
                                    <th>Name</th>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
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
        let $rolesTable;

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $rolesTable = $('#rolesTable').DataTable({
                processing: true,
                serverSide: true,
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
                ajax: {
                    url: '{!! route('admin.roles.index') !!}',
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'display_name',
                        name: 'display_name'
                    },
                    {
                        data: 'permissions',
                        name: 'permissions'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                    targets: [0, 4],
                    className: "text-center"
                }],
            });


            $(document).on('click', '.delete-btn', function(e) {
                e.stopPropagation();
                e.stopImmediatePropagation();
                let id = $(this).closest('tr').attr('id');
                let url = "{{ route('admin.roles.destroy', ':id') }}";
                url = url.replace(':id', id);
                deleteInfo(url, $rolesTable)
            });
        });
    </script>
@endpush
