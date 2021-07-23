@extends('layouts.master')

@section('content-header')
    @include('layouts.partials.contentHeader',$info =[
    'title' =>'Roles',
    'subtitle' => 'Administracion',
    'breadCrumbs' =>['roles','create']
    ])
@stop

@section('content-header')
    @include('layouts.partials.contentHeader',$info =[
    'title' =>'Roles',
    'subtitle' => 'Creacion',
    'breadCrumbs' =>['roles','create']
    ])
@stop

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3>Registro de Roles</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="createRolesForm" name="createRolesForm"
                            action="{{ route('admin.roles.store') }}">

                            @include('admin.roles.partials.form')

                            <button class="btn btn-primary btn-block">Crear Role</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#createRolesForm').on('submit', function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');;
                let data = $(this).serialize();
                myAjax(url, method, $(this), data);
            });

        });
    </script>
@endpush
