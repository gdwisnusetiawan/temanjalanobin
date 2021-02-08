<header id="header" class="dark submenu-light header-logo-center">
    <div class="header-inner">
        <div class="container">
            <!--Logo-->
            <div id="logo">
                <a href="{{ url('/') }}">
                    <!-- <span class="logo-default"><img src="{{ asset('logo.png') }}" alt="logo-tutoya-default" class="h-100"></span> -->
                    <!-- <span class="logo-dark">Tutoya</span> -->
                    <img src="{{ asset($config->logo) }}" alt="logo-tutoya-dark" class="logo-default">
                    <img src="{{ asset($config->logo_dark) }}" alt="logo-tutoya-dark" class="logo-dark">
                </a>
            </div>
            <!--End: Logo-->
            <!-- Search -->
            <div id="search"><a id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i class="icon-x"></i></a>
                <form class="search-form" action="search-results-page.html" method="get">
                    <input class="form-control" name="q" type="text" placeholder="Type & Search..." />
                    <span class="text-muted">Start typing & press "Enter" or "ESC" to close</span>
                </form>
            </div> <!-- end: search -->
            <!--Header Extras-->
            <div class="header-extras">
                <ul>
                    <li> <a id="btn-search" href="#"> <i class="icon-search"></i></a> </li>
                    <li>
                        <a id="btn-notifcation" href="{{ route('cart.index') }}"> 
                            <i class="icon-shopping-cart"></i>
                            @if(session('cart'))
                                <span class="badge badge-light">{{ session('cart')['summary']['total_quantity'] }}</span>
                            @endif
                        </a> 
                    </li>
                    <!-- <li><a class="btn">
                        <i class="icon-shopping-cart"></i> <span class="badge badge-light">4</span>
                    </a></li> -->
                    <li>
                        <div class="p-dropdown"> <a href="#"><i class="icon-globe"></i><span>EN</span></a>
                            <ul class="p-dropdown-content">
                                <li><a href="#">English</a></li>
                                <li><a href="#">Indonesia</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <!--end: Header Extras-->
            <!--Navigation Resposnive Trigger-->
            <div id="mainMenu-trigger"> <a class="lines-button x"><span class="lines"></span></a> </div>
            <!--end: Navigation Resposnive Trigger-->
            <!--Navigation-->
            <div id="mainMenu" class="menu-creative">
                <div class="container">
                    <nav>
                        <!-- left menu -->
                        <ul>
                            <li class="{{ request()->is('/') ? 'current' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                            <li class="{{ request()->is('dashboard') ? 'current' : '' }}"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="{{ request()->is('dashboard/pengguna*') ? 'current' : '' }}"><a href="">Alih Pengguna</a></li>
                            <li class="{{ request()->is('dashboard/bonus*') ? 'current' : '' }}"><a href="">Bonus</a></li>
                        </ul>
                        <!-- right menu -->
                        <ul>
                            <li class="{{ request()->is('dashboard/transaction*') ? 'current' : '' }}"><a href="">Riwayat Transaksi</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('dashboard.order') }}">Pembelian Pribadi</a></li>
                                    <li><a href="{{ route('dashboard.user.registration', auth()->user()) }}">Pendaftaran</a></li>
                                    <li><a href="">Redeem Voucher</a></li>
                                </ul>
                            </li>
                            @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            @else
                            <li class="dropdown">
                                <a href="#">
                                    <!-- {{ auth()->user()->name }} -->
                                    <img src="{{ auth()->user()->avatar }}" class="avatar avatar-sm">
                                </a>
                                <ul class="dropdown-menu active">
                                    <li class="text-center">
                                        <img src="{{ auth()->user()->avatar }}" class="avatar avatar-lg">
                                        <a href="{{ route('dashboard.welcome') }}"><span>{{ auth()->user()->fullname }}</span></a>
                                    </li>
                                    <li><hr></li>
                                    <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                    <li><a href="{{ route('dashboard.order') }}">History</a></li>
                                    <li><hr></li>
                                    <li><a href="{{ route('dashboard.user.index', auth()->user()) }}">Account Settings</a></li>
                                    <li><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                            @endguest
                        </ul>
                    </nav>
                </div>
            </div>
            <!--end: Navigation-->
        </div>
    </div>
</header>