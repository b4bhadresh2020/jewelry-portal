<header>
    <div class="header-top-wrapper">
        <div class="container">
            <div class="header-top-inner">
                <ul>
                    <li><a href="#">24/7 Customer Service</a></li>
                    <li><a href="#">Lifetime Warranty</a></li>
                    <li><a href="#">Free International Shipping</a></li>
                    <li><a href="#">100% Money Back Gurantee</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-bottom-wrapper">
        <div class="container">
            <div class="header-bottom-inner">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-5 mobile-header-left">
                        <div class="header-bottom-left">
                            <div class="header-bottom-call">
                                <a href="#">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <div class="header-bottom-call-text">
                                        <span class="text">Call or Text 24/7</span>
                                        <span class="no">+91 95375 19120</span>
                                    </div>
                                </a>
                            </div>
                            <div class="header-bottom-email">
                                <a href="#">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    <div class="header-email-text">
                                        <span class="email-name">Email Us</span>
                                        <span class="email-envelope">info@jamesallen.com</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 header-search-wrapper">
                        <div class="header-search">
                            <div class="header-search-inner">
                                <input id="email" type="text" class="form-control" name="email" placeholder="{{ __('locale.Search')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26.31 26.3">
                                    <path d="M16.49,18.94a10.42,10.42,0,1,1,2.45-2.45l6.86,6.86a1.7,1.7,0,0,1,0,2.42l0,0a1.71,1.71,0,0,1-2.42,0Zm-6-.52a8,8,0,1,0-8-8,8,8,0,0,0,8,8Z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-7 mobile-header-right">
                        <div class="header-bottom-right">
                            <div class="header-bottom-login header-bottom-right-inner">
                                @auth
                                    <a href="{{ url('signout') }}">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Logout</span>
                                    </a>
                                @endauth

                                @guest
                                    <a href="{{ url('signin') }}">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Login</span>
                                    </a>
                                @endguest
                            </div>
                            <div class="header-bottom-wishlist header-bottom-right-inner">
                                <a href="{{ url('dashboard') }}">
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                    <span>Dashboard</span>
                                </a>
                            </div>

                            <div class="header-bottom-cart header-bottom-right-inner">
                                <a href="{{url('/cart')}}">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                <span>My Cart</span>
                                <span class="cart-count" id="cart-counter">{{$cartCount}}</span>
                                </a>
                            </div>
                            <div class="header-bottom-currency">
                                <div class="header-bottom-currency-button">
                                    <a>
                                        @foreach ($findFrontLanguage as $lang)
                                            @if ($lang->code == $locale)
                                                <span><img src="{{ url('assets/img/lang') }}/{{ $lang->code }}.png" alt=""></span>
                                            @endif
                                        @endforeach
                                    </a>
                                </div>
                                <ul>
                                    @foreach ($findFrontLanguage as $lang)
                                        <li>
                                            <a href="{{ url('lang') }}/{{ $lang->code }}">
                                                <span><img src="{{ url('assets/img/lang') }}/{{ $lang->code }}.png" alt=""> {{ $lang->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4 header-menu-left">
                    <div class="header-logo">
                        <a href="{{ url('/') }}"><img src="{{asset('assets')}}/img/header-logo.png"></a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-4 col-sm-4 header-menu-center">
                    <div class="header-menu-inner">
                      <button class="navbar-toggler header-menu-button" type="button" data-toggle="collapse" data-target="#megamenu" aria-controls="megamenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                      </button>
                    <div class="header-menu" id="megamenu">
                      <div class="megamenu-top-block">
                        <h3>Mega Menu</h3>
                        <a href="#" class="megamenu-close"><i class="fa fa-times" aria-hidden="true"></i></a>
                      </div>
                      <ul class="nav-list">
                        @foreach ($userMenus as $key=>$menu)
                            <li class="nav-item @if($key==0)active @endif">
                                <a href="@isset($menu->submenu[0])javascript:void(0)@else{{$menu->link}} @endisset" >{{$menu->title}}  <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                @isset($menu->submenu[0])
                                    @if(!$menu->submenu->isEmpty())
                                        <div class="megamenu-inner">
                                            <div class="submenu-block">
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-12 col-sm-12">
                                                        <div class="submenu-block1">
                                                            <div class="submenu-title">
                                                                <h4>Shop By Category</h4>
                                                            </div>
                                                            <div class="submenu-block1-inner">
                                                                <ul>
                                                                    @foreach ($menu->submenu as $submenu)
                                                                        <li>
                                                                            <a href="@if($submenu->link!=null){{$submenu->link}}@else  javascript:void(0) @endif">
                                                                                <img src="{{@getMediaUrlToUrl($submenu->media->path)}}">
                                                                                <span>{{ $submenu->title }}</span>
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-12 col-sm-12">
                                                    <div class="submenu-block2">
                                                        <div class="submenu-title">
                                                            <h4>SHOP BY METAL & STONE</h4>
                                                        </div>
                                                        <div class="submenu-block2-inner">
                                                            <ul>
                                                            <li>
                                                                <a href="#">
                                                                <img src="{{asset('assets/img/submenu-block2-1.png')}}">
                                                                <span>GEMSTONE</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                <img src="{{asset('assets/img/submenu-block2-2.png')}}">
                                                                <span>SOLITAIRE</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                <img src="{{asset('assets/img/submenu-block2-3.png')}}">
                                                                <span>DIAMOND</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                <img src="{{asset('assets/img/submenu-block2-4.png')}}">
                                                                <span>PLATINUM</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                <img src="{{asset('assets/img/submenu-block2-5.png')}}">
                                                                <span>YELLOW GOLD</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                <img src="{{asset('assets/img/submenu-block2-6.png')}}">
                                                                <span>WHITE GOLD</span>
                                                                </a>
                                                            </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-12 col-sm-12">
                                                    <div class="submenu-block3-4">
                                                        <div class="submenu-block3">
                                                            <div class="submenu-title">
                                                            <h4>SHOP BY</h4>
                                                            </div>
                                                            <div class="submenu-block3-inner">
                                                            <ul>
                                                                <li>
                                                                <a href="#"><span>FOR MEN</span></a>
                                                                </li>
                                                                <li>
                                                                <a href="#"><span>Under ₹ 10k</span></a>
                                                                </li>
                                                                <li>
                                                                <a href="#"><span>₹ 10k to ₹ 20k</span></a>
                                                                </li>
                                                                <li>
                                                                <a href="#"><span>₹ 20k to ₹ 30k</span></a>
                                                                </li>
                                                                <li>
                                                                <a href="#"><span>Above ₹ 30k</span></a>
                                                                </li>
                                                            </ul>
                                                            </div>
                                                        </div>
                                                        <div class="submenu-block4">
                                                            <div class="submenu-title">
                                                            <h4>SALE</h4>
                                                            </div>
                                                            <div class="submenu-block3-inner">
                                                            <ul>
                                                                <li>
                                                                <a href="#"><span>SHOW ALL DESIGNS</span></a>
                                                                </li>
                                                                <li>
                                                                <a href="#"><span>ON SALE</span></a>
                                                                </li>
                                                            </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                    <div class="submenu-block5">
                                                        <img src="{{@getMediaUrlToUrl($menu->media->path)}}">
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endisset
                            </li>
                        @endforeach
                      </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

