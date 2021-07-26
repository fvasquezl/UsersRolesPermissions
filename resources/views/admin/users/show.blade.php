@extends('layouts.master')

@section('content-header')
    @include('layouts.partials.contentHeader',$info =[
    'title' =>'Users',
    'subtitle' => 'Administration',
    'breadCrumbs' =>['users','show']
    ])
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/user1.png') }}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $user->name }}</h3>

                        <p class="text-muted text-center">{{ $user->roles->first()->name }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <i class="fas fa-envelope"></i> <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-calendar-alt"></i> <b>User from:</b> <a
                                    class="float-right">{{ $user->present()->userCreatedat() }}</a>
                            </li>

                        </ul>

                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-block"><b>Edit</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="col-md-3">
                <!-- About Me Box -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Roles</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @forelse ($user->roles as $role)
                            <strong>{{ $role->name }}</strong>
                            @if ($role->permissions->count())
                                <br>
                                <small class="text-muted">
                                    Permissions: {{ $role->permissions->pluck('name')->implode(', ') }}
                                </small>
                            @endif
                            @unless($loop->last)
                                <hr>
                            @endunless
                        @empty
                            <small class="text-muted">It has no associated role</small>
                        @endforelse
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-3">
                <!-- About Me Box -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Additional permissions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @forelse ($user->permissions as $permission)
                            <strong>{{ $permission->name }}</strong>
                            @unless($loop->last)
                                <br>
                            @endunless
                        @empty
                            <small class="text-muted">Has no additional permissions</small>
                        @endforelse
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
    </div>
@endsection
