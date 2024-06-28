<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        {{--  users LI --}}
        <li class="nav-item menu">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add new user</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- End users LI --}}
        {{--  roles LI --}}
        <li class="nav-item menu">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Roles
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add new role</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- End roles LI --}}
        <li class="nav-item mt-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-secondary form-control">Logout</button>
            </form>
        </li>
    </ul>
</nav>
