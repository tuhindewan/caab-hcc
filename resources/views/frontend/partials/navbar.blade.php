<nav class="main-header navbar navbar-expand-md navbar-light navbar-white fixed-top">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ asset('img/caab-logo.jpeg') }}" alt="CAAB"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">HCC</span>
        </a>
        <div class="collapse navbar-collapse order-3">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a href="#" class="nav-link">Contact</a>
                </li>
                <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="#" class="dropdown-item">Some action </a></li>
                    <li><a href="#" class="dropdown-item">Some other action</a></li>

                    <li class="dropdown-divider"></li>

                    <!-- Level two dropdown-->
                    <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                        <li>
                        <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                        </li>

                        <!-- Level three dropdown-->
                        <li class="dropdown-submenu">
                        <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                        <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                            <li><a href="#" class="dropdown-item">3rd level</a></li>
                            <li><a href="#" class="dropdown-item">3rd level</a></li>
                        </ul>
                        </li>
                        <!-- End Level three -->

                        <li><a href="#" class="dropdown-item">level 2</a></li>
                        <li><a href="#" class="dropdown-item">level 2</a></li>
                    </ul>
                    </li>
                    <!-- End Level two -->
                </ul>
                </li>
            </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3">
            <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
                </button>
            </div>
            </div>
        </form>
        </div>

        @auth
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" href="{{ url('/home') }}">
                Home
                </a>
            </li>
        </ul>
        @else
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('login') }}">
                Login
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('register') }}">
                Register
                </a>
            </li>
        </ul>
        @endauth
    </div>
</nav>

