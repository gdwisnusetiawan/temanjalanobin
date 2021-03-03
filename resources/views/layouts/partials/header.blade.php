<header id="header" class="light">
    <div class="header-inner">
        <div class="container">
            <!--Logo-->
            <div id="logo">
                <a href="{{ url('/') }}">
                    <!-- <span class="logo-default"><img src="{{ asset('logo.png') }}" alt="logo-tutoya-default" class="h-100"></span> -->
                    <!-- <span class="logo-dark">Tutoya</span> -->
                    <img src="{{ isset($config) ? $config->logo_url : '' }}" alt="logo" class="logo-default py-3">
                    <img src="{{ isset($config) ? asset($config->logo_dark) : '' }}" alt="logo-dark" class="logo-dark">
                </a>
            </div>
            <!--End: Logo-->
            <!-- Search -->
            <!-- <div id="search"><a id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i class="icon-x"></i></a>
                <form class="search-form" action="search-results-page.html" method="get">
                    <input class="form-control" name="q" type="text" placeholder="Type & Search..." />
                    <span class="text-muted">Start typing & press "Enter" or "ESC" to close</span>
                </form>
            </div>  -->
            <!-- end: search -->
            <!--Header Extras-->
            <div class="header-extras">
                <ul>
                    <!-- <li> <a id="btn-search" href="#"> <i class="icon-search"></i></a> </li> -->
                    <li>
                        <a id="btn-notifcation" href="{{ route('cart.index') }}"> 
                            <i class="icon-shopping-cart"></i>
                            @if(session('cart'))
                                <span class="badge badge-light" id="cart-icon-quantity">{{ session('cart')['summary']['total_quantity'] }}</span>
                            @endif
                        </a> 
                    </li>
                    <!-- <li><a class="btn">
                        <i class="icon-shopping-cart"></i> <span class="badge badge-light">4</span>
                    </a></li> -->
                    <!-- <li>
                        <div class="p-dropdown"> <a href="#"><i class="icon-globe"></i><span>EN</span></a>
                            <ul class="p-dropdown-content">
                                <li><a href="#">English</a></li>
                                <li><a href="#">Indonesia</a></li>
                            </ul>
                        </div>
                    </li> -->
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
                        @isset($menus)
                        <!-- left menu -->
                        <ul>
                            @foreach($menus[0] as $menu)
                                <li class="{{ request()->is($menu->slug.'*') ? 'current' : '' }}"><a href="{{ !$menu->isMegaMenu() ? $menu->url : '#' }}">{{ $menu->title }}</a>
                                    @if($menu->submenus->count() > 0 && $menu->submenus->count() <= 8)
                                    <ul class="dropdown-menu">
                                        @foreach($menu->submenus as $submenu)
                                            <li><a href="{{ $submenu->url }}">{{ $submenu->title }}</a></li>
                                        @endforeach
                                    </ul>
                                    @elseif($menu->isMegaMenu())
                                    <ul class="dropdown-menu">
                                        @if($menu->isContains('title', ['belanja', 'shop', 'categories']))
                                            @foreach($categories as $category)
                                                <li><a href="{{ route('shop.index', $category) }}">{{ $category->title }}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    @endif
                                </li>
                            @endforeach
                            <!-- <li class="{{ request()->is('/') ? 'current' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                            <li class="dropdown mega-menu-item {{ request()->is('shop*') ? 'current' : '' }}"><a href="#">Shop</a>
                                <ul class="dropdown-menu">
                                    <li class="mega-menu-content">
                                        <div class="row">
                                            <div class="col-lg-2-5">
                                                <ul>
                                                    <li class="mega-menu-title">Category A</li>
                                                    <li><a href="#">Minuman Diet</a></li>
                                                    <li><a href="#">Sub Category 1</a></li>
                                                    <li><a href="#">Sub Category 2</a></li>
                                                    <li><a href="#">Sub Category 3</a></li>
                                                    <li><a href="#">Sub Category 4</a></li>
                                                    <li><a href="#">Sub Category 5</a></li>
                                                    <li><a href="#">Sub Category 6</a></li>
                                                    <li><a href="#">Sub Category 7</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-2-5">
                                                <ul>
                                                    <li class="mega-menu-title">Category B</li>
                                                    <li><a href="#">Sub Category 1</a></li>
                                                    <li><a href="#">Sub Category 2</a></li>
                                                    <li><a href="#">Sub Category 3</a></li>
                                                    <li><a href="#">Sub Category 4</a></li>
                                                    <li><a href="#">Sub Category 5</a></li>
                                                    <li><a href="#">Sub Category 6</a></li>
                                                    <li><a href="#">Sub Category 7</a></li>
                                                    <li><a href="#">Sub Category 8</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-2-5">
                                                <ul>
                                                    <li class="mega-menu-title">Category C</li>
                                                    <li><a href="#">Sub Category 1</a></li>
                                                    <li><a href="#">Sub Category 2</a></li>
                                                    <li><a href="#">Sub Category 3</a></li>
                                                    <li><a href="#">Sub Category 4</a></li>
                                                    <li><a href="#">Sub Category 5</a></li>
                                                    <li><a href="#">Sub Category 6</a></li>
                                                    <li><a href="#">Sub Category 7</a></li>
                                                    <li><a href="#">Sub Category 8</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-2-5">
                                                <ul>
                                                    <li class="mega-menu-title">Category D</li>
                                                    <li><a href="#">Sub Category 1</a></li>
                                                    <li><a href="#">Sub Category 2</a></li>
                                                    <li><a href="#">Sub Category 3</a></li>
                                                    <li><a href="#">Sub Category 4</a></li>
                                                    <li><a href="#">Sub Category 5</a></li>
                                                    <li><a href="#">Sub Category 6</a></li>
                                                    <li><a href="#">Sub Category 7</a></li>
                                                    <li><a href="#">Sub Category 8</a></li>
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
                            </li> -->
                        <!-- </ul> -->
                        <!-- right menu -->
                        <!-- <ul> -->
                        @isset($menus[1])
                            @foreach($menus[1] as $menu)
                                <li class="{{ request()->is($menu->slug.'*') ? 'current' : '' }}"><a href="{{ !$menu->isMegaMenu() ? $menu->url : '#' }}">{{ $menu->title }}</a>
                                    @if($menu->submenus->count() > 0 && $menu->submenus->count() <= 8)
                                    <ul class="dropdown-menu">
                                        @foreach($menu->submenus as $submenu)
                                            <li><a href="{{ $submenu->url }}">{{ $submenu->title }}</a></li>
                                        @endforeach
                                    </ul>
                                    @elseif($menu->isMegaMenu())
                                    <ul class="dropdown-menu">
                                        @if($menu->isContains('title', ['belanja', 'shop', 'categories']))
                                            @foreach($categories as $category)
                                                <li><a href="{{ route('shop.index', $category) }}">{{ $category->title }}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endisset
                            <li class="{{ request()->is('dashboard*') ? 'current' : '' }}"><a href="#">My Account</a>
                                <ul class="dropdown-menu">
                                    @guest
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    @else
                                    <!-- <li class="text-center">
                                        <img src="{{ auth()->user()->avatar }}" class="avatar avatar-lg">
                                        <a href="{{ route('dashboard.welcome') }}"><span>{{ auth()->user()->fullname }}</span></a>
                                    </li>
                                    <li><hr></li> -->
                                    <li><a href="{{ route('dashboard.order') }}">Billing</a></li>
                                    <!-- <li><a href="">History</a></li> -->
                                    <li><hr></li>
                                    <li><a href="{{ route('dashboard.user.index', auth()->user()) }}">Edit Profile</a></li>
                                    <li><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    @endguest
                                </ul>
                            </li>
                            @auth
                            <li>
                                <a href="{{ route('dashboard.welcome') }}"><img src="{{ auth()->user()->avatar }}" class="avatar avatar-sm"></a>
                                <!-- <a href="{{ route('dashboard.welcome') }}"><span>{{ auth()->user()->fullname }}</span></a> -->
                            </li>
                            @endauth
                        </ul>
                        @endisset
                    </nav>
                </div>
            </div>
            <!--end: Navigation-->
        </div>
    </div>
</header>