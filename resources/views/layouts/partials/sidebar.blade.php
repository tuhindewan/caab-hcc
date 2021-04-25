<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
    <img src="{{ asset('img/caab-logo.jpeg') }}" alt="caab logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">HCC</span>
    </a>

    <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{ asset('img/profile.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
    </div>

    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
        </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt text-blue"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ Route::is('admin.employee.create') ||
                                    Route::is('admin.employees.index') ||
                                    Route::is('admin.employee.edit') ||
                                    Route::is('admin.users.index') ||
                                    Route::is('admin.employee.show') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cogs text-green"></i>
                    <p>
                        Management
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item {{ Route::is('admin.employee.create') ||
                                            Route::is('admin.employees.index') ||
                                            Route::is('admin.employee.edit') ||
                                            Route::is('admin.employee.show') ? 'active_menu' : '' }}">
                        <a href="{{ route('admin.employees.index') }}" class="nav-link">
                            <i class="fas fa-pen-nib nav-icon"></i>
                            <p>Employees</p>
                        </a>
                    </li>

                    <li class="nav-item {{ Route::is('admin.users.index') ? 'active_menu' : '' }}">
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Users</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ Route::is('admin.profile.getProfileData') ? 'active_menu' : '' }}">
                <a href="{{ route('admin.profile.getProfileData') }}" class="nav-link">
                    <i class="nav-icon fas fa-user text-yellow"></i>
                    <p>Profile</p>
                </a>
            </li>
            <li class="nav-item {{ Route::is('applicant.account') ? 'active_menu' : '' }}">
                <a href="{{ route('applicant.account') }}" class="nav-link">
                    <i class="nav-icon fas fa-cog text-cyan"></i>
                    <p>Account</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-power-off text-red"></i>

                    <p>{{ __('Logout') }}</p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
    </div>
</aside>

