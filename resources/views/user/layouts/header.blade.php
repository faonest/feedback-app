<nav class="rt_nav_header horizontal-layout col-lg-12 col-12 p-0">
    <div class="top_nav flex-grow-1">
        <div class="container d-flex flex-row h-100 align-items-center">

            <div class="text-center rt_nav_wrapper d-flex align-items-center">
                <a class="navbar-brand" style="color: white" href="{{ url('/') }}">FEEDBACK</a>
            </div>

            <div class="nav_wrapper_main d-flex align-items-center justify-content-between flex-grow-1">
                <ul class="navbar-nav navbar-nav-right mr-0 ml-auto">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <span class="profile_name">{{ Auth::user()->name }}<i
                                    class="feather ft-chevron-down"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown pt-2"
                            aria-labelledby="profileDropdown">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <i class="ti-user text-dark mr-3"></i> Profile
                            </a>

                            <span role="separator" class="divider"></span>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item"
                                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                                    <i class="ti-power-off text-dark mr-3"></i>
                                    Logout
                                </a>
                            </form>

                        </div>
                    </li>
                </ul>

                <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="feather ft-menu text-white"></span>
                </button>

            </div>
        </div>
    </div>
    <div class="nav-bottom">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item">
                    <a href="{{ route('user.dashboard') }}" class="nav-link"><i
                            class="menu_icon feather ft-home"></i><span class="menu-title">Dashboard</span></a>
                </li>

                <li class="nav-item mega-menu">
                    <a href="{{ route('feedback') }}" class="nav-link"><i class="menu_icon feather ft-gitlab"></i><span
                            class="menu-title">Feedbacks</span></a>
                </li>
            </ul>
        </div>
    </div>

</nav>
