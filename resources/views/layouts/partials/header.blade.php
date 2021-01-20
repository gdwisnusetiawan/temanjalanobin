<header id="header" class="dark submenu-light">
    <div class="header-inner">
        <div class="container">
            <!--Logo-->
            <div id="logo"> <a href="index.html"><span class="logo-default">TUTOYA</span><span class="logo-dark">TUTOYA</span></a> </div>
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
                    <li> <a id="btn-search" href="{{ route('shop.cart') }}"> <i class="icon-shopping-cart"></i></a> </li>
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
                        <ul>
                            <li class="{{ request()->is('/') ? 'current' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                            <li class="dropdown mega-menu-item {{ request()->is('shop*') ? 'current' : '' }}"><a href="#">Shop</a>
                                <ul class="dropdown-menu">
                                    <li class="mega-menu-content">
                                        <div class="row">
                                            <div class="col-lg-2-5">
                                                <ul>
                                                    <li class="mega-menu-title">Category A</li>
                                                    <li><a href="{{ route('shop.index') }}">Minuman Diet</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 1</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 2</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 3</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 4</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 5</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 6</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 7</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-2-5">
                                                <ul>
                                                    <li class="mega-menu-title">Category B</li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 1</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 2</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 3</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 4</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 5</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 6</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 7</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 8</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-2-5">
                                                <ul>
                                                    <li class="mega-menu-title">Category C</li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 1</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 2</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 3</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 4</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 5</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 6</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 7</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 8</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-2-5">
                                                <ul>
                                                    <li class="mega-menu-title">Category D</li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 1</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 2</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 3</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 4</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 5</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 6</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 7</a></li>
                                                    <li><a href="{{ route('shop.index') }}">Sub Category 8</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-2-5 p-l-0">
                                                <h4 class="text-theme">BIG SALE<small>Up to</small></h4>
                                                <h2 class="text-lg text-theme lh80 m-b-30">70%</h2>
                                                <p class="m-b-0">The most happiest time of the day!. Morbi sagittis, sem quis ipsum dolor sit amet lacinia faucibus.</p><a class="btn btn-shadow btn-rounded btn-block m-t-10">SHOP NOW!</a><small class="t300">
                                                    <p class="text-center m-0"><em>* Limited time Offer</em></p>
                                                </small>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ request()->is('about*') ? 'current' : '' }}"><a href="{{ route('about') }}">About Us</a></li>
                            <li class="{{ request()->is('news*') ? 'current' : '' }}"><a href="{{ route('news.index') }}">News</a></li>
                            <li class="{{ request()->is('faq*') ? 'current' : '' }}"><a href="{{ route('faq') }}">FAQ</a></li>
                            <li class="{{ request()->is('contact*') ? 'current' : '' }}"><a href="{{ route('contact') }}">Contact</a></li>
                            @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            @else
                            <li class="dropdown"><a href="#">{{ auth()->user()->name }}</a>
                                <ul class="dropdown-menu">
                                    <li><a href="">Account Settings</a></li>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
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