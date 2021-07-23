@extends('layouts.master')

@section('content-header')
    @include('layouts.partials.contentHeader',$info =[
    'title' =>'Usuarios',
    'subtitle' => 'Edicion',
    'breadCrumbs' =>['users','edit']
    ])
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3>Datos Personales</h3>
                    </div>
                    <div class="card-body">
                        <form method="PUT" id="updateUserForm" name="updateUserForm"
                            action="{{ route('admin.users.update', $user->id) }}">
                            {{-- @csrf
                        @method('PUT') --}}

                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input name="name" value="{{ old('name', $user->name) }}" class="form-control">

                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                            </div>

                            <div class="form-group">
                                <label for="username">Nombre de Usuario:</label>
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
                                <label for="password">Contrasena:</label>
                                <input name="password" type="password" class="form-control" placeholder="Contrasena">
                                <span class="text-muted">Dejar en blanco si no se quiere cambiar la contrasena</span>

                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Repita la contrasena:</label>
                                <input name="password_confirmation" type="password" class="form-control"
                                    placeholder="Repite la contrasena">


                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                            </div>

                            <button class="btn btn-primary btn-block">Actualizar Usuario</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3>Roles</h3>
                    </div>
                    <div class="card-body">
                        @role('Admin')
                        <form method="PUT" id="updateRolesForm" name="updateRolesForm"
                            action="{{ route('admin.users.roles.update', $user) }}">
                            {{-- @csrf
                            @method('PUT') --}}

                            @include('admin.roles.partials.checkboxes')

                            <button class="btn btn-primary btn-block">Actualizar roles</button>
                        </form>
                    @else
                        <ul class="list-group">
                            @forelse ($user->roles as $role)
                                <li class="list-group-item">
                                    {{ $role->name }}
                                </li>
                            @empty
                                <li class="list-group-item">
                                    No tiene roles
                                </li>
                            @endforelse
                        </ul>
                        @endrole
                    </div>
                </div>
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3>Permisos</h3>
                    </div>
                    <div class="card-body">
                        @role('Admin')
                        <form method="PUT" id="updatePermissionsForm" name="updatePermissionsForm"
                            action="{{ route('admin.users.permissions.update', $user) }}">

                            @include('admin.permissions.partials.checkboxes',['model'=> $user])

                            <button class="btn btn-primary btn-block">Actualizar permisos</button>
                        </form>
                    @else
                        <ul class="list-group">
                            @forelse ($user->permissions as $permission)
                                <li class="list-group-item">
                                    {{ $permission->name }}
                                </li>
                            @empty
                                <li class="list-group-item">
                                    No tiene permisos
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
