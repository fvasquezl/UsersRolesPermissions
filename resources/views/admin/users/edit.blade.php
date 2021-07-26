@extends('layouts.master')

@section('content-header')
    @include('layouts.partials.contentHeader',$info =[
    'title' =>'Users',
    'subtitle' => 'Administration',
    'breadCrumbs' =>['users','edit']
    ])
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Personal Info</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="PUT" id="updateUserForm" name="updateUserForm"
                            action="{{ route('admin.users.update', $user->id) }}">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input name="name" value="{{ old('name', $user->name) }}" class="form-control">

                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                            </div>

                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input name="username" value="{{ old('username', $user->username) }}"
                                    class="form-control">

                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input name="email" value="{{ old('email', $user->email) }}" class="form-control">

                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input name="password" type="password" class="form-control" placeholder="Contrasena">
                                <span class="text-muted">Leave blank if you do not want to change the password</span>

                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Password confirmation:</label>
                                <input name="password_confirmation" type="password" class="form-control"
                                    placeholder="Repite la contrasena">


                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                            </div>

                            <button class="btn btn-primary btn-block">Update User</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Roles</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @role('Admin')
                        <form method="PUT" id="updateRolesForm" name="updateRolesForm"
                            action="{{ route('admin.users.roles.update', $user) }}">

                            @include('admin.roles.partials.checkboxes')

                            <button class="btn btn-primary btn-block">Update roles</button>
                        </form>
                    @else
                        <ul class="list-group">
                            @forelse ($user->roles as $role)
                                <li class="list-group-item">
                                    {{ $role->name }}
                                </li>
                            @empty
                                <li class="list-group-item">
                                    Has no roles
                                </li>
                            @endforelse
                        </ul>
                        @endrole
                    </div>
                </div>
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Permissions</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @role('Admin')
                        <form method="PUT" id="updatePermissionsForm" name="updatePermissionsForm"
                            action="{{ route('admin.users.permissions.update', $user) }}">

                            @include('admin.permissions.partials.checkboxes',['model'=> $user])

                            <button class="btn btn-primary btn-block">Update Permissions</button>
                        </form>
                    @else
                        <ul class="list-group">
                            @forelse ($user->permissions as $permission)
                                <li class="list-group-item">
                                    {{ $permission->name }}
                                </li>
                            @empty
                                <li class="list-group-item">
                                    Has no permissions
                                </li>
                            @endforelse
                        </ul>
                        @endrole
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

            $('#updateUserForm').on('submit', function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');;
                let data = $(this).serialize();
                myAjax(url, method, $(this), data);
            });

            $('#updateRolesForm').on('submit', function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');;
                let data = $(this).serialize();
                myAjax(url, method, $(this), data);
            });
            $('#updatePermissionsForm').on('submit', function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let method = $(this).attr('method');;
                let data = $(this).serialize();
                myAjax(url, method, $(this), data);
            });
        });
    </script>
@endpush
