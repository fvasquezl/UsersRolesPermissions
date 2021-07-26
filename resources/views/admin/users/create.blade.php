@extends('layouts.master')


@section('content-header')
    @include('layouts.partials.contentHeader',$info =[
    'title' =>'Users',
    'subtitle' => 'Administration',
    'breadCrumbs' =>['users','create']
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
                        <h3 class="card-title">Create Users</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="createUsersForm" name="createUsersForm"
                            action="{{ route('admin.users.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input name="name" value="{{ old('name') }}" class="form-control">
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input name="username" value="{{ old('username') }}" class="form-control">
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input name="email" value="{{ old('email') }}" class="form-control">
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Roles:</label>
                                    @include('admin.roles.partials.checkboxes')
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Permissions:</label>
                                    @include('admin.permissions.partials.checkboxes',['model'=> $user])
                                </div>
                            </div>

                            <span class="help-block">The password will be generated and sent to the new user via
                                email</span>

                            <button class="btn btn-primary btn-block">Create User</button>
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

            $('#createUsersForm').on('submit', function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');;
                let data = $(this).serialize();
                myAjax(url, method, $(this), data);

                // window.location.href = "{{ route('admin.users.index') }}";
            });

        });
    </script>
@endpush
