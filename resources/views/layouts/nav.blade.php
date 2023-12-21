<!-- nav -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('project.index') }}" class="nav-link">{{ __('Projets') }}</a>
        </li>
        @can('view', App\Models\Member::class)
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('member.index') }}" class="nav-link">{{ __('Membres') }}</a>
            </li>
        @endcan --}}

    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fa-solid fa-language"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0" style="left: inherit; right: 0px;">
                <a href="#" class="dropdown-item active">
                    English
                </a>
                <a href="#" class="dropdown-item ">
                    French
                </a>
            </div>
        </li>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="https://assets.infyom.com/logo/blue_logo_150x150.png"
                        class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ Auth::user()->lastName }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="https://assets.infyom.com/logo/blue_logo_150x150.png" class="img-circle elevation-2"
                            alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        {{-- <a href="#" class="btn btn-default btn-flat">Profile</a> --}}
                        <a href="#" class="btn btn-default btn-flat float-right"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Se déconnecter
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa-solid fa-user"></i>
            </a>
            <div style="left: inherit; right: 0px;"
                class="dropdown-menu dropdown-menu-sm dropdown-menu-right text-center">
                <a href="#" class="dropdown-item">
                    {{ __('words.profile_link') }}
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        {{ __('Se déconnecter') }}
                    </button>
                </form>
            </div>
        </li> --}}

    </ul>
</nav>
