<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('img/book.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/user1.png') }}" class="img-circle elevation-2"
                    alt="{{ auth()->user()->name }}">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu"
                data-accordion="false">

                @can('view', new App\Models\User())
                    <li class="nav-item {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}"
                                    class="{{ setActiveRoute('admin.users.index') }}">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>All Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.create') }}"
                                    class="{{ setActiveRoute('admin.users.create') }}">
                                    <i class="fas fa-users-cog nav-icon"></i>
                                    <p>Create Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('admin.users.show', auth()->user()) }}"
                            class="{{ setActiveRoute('admin.users.edit') }}">
                            <i class="fas fa-user-friends nav-icon"></i>
                            <p>Perfil</p>
                        </a>
                    </li>
                @endcan


                @can('view', new \Spatie\Permission\Models\Role())
                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}" class="{{ setActiveRoute('admin.roles.index') }}">
                            <i class="fas fa-user-secret nav-icon"></i>
                            <p>
                                Roles
                            </p>
                        </a>
                    </li>
                @endcan



                @can('view', new \Spatie\Permission\Models\Permission())
                    <li class="nav-item">
                        <a href="{{ route('admin.permissions.index') }}"
                            class="{{ setActiveRoute('admin.permissions.index') }}">
                            <i class="fas fa-key nav-icon"></i>
                            <p>
                                Permissions
                            </p>
                        </a>
                    </li>
                @endcan

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
