<!-- aside -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('project.index') }}" class="brand-link">
        <img src="https://assets.infyom.com/logo/blue_logo_150x150.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light text-center">{{ __('Solicoders') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('project.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            {{ __('Projets') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (isset($project))
                        <a href="{{ route('task.index', ['project' => $project]) }}" class="nav-link">
                        @else
                            <a href="#" class="nav-link">
                    @endif
                    <i class="nav-icon fa-solid fa-bars-progress"></i>
                    <p> {{ __('Taches') }} </p>
                    </a>
                </li>
                @role('leader')
                    <li class="nav-item">
                        <a href="{{ route('member.index') }}" class="nav-link ">
                            <i class="fa-solid fa-users pl-1 pr-1"></i>
                            <p>
                                {{ __('Membres') }}
                            </p>
                        </a>
                    </li>
                @endrole
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
