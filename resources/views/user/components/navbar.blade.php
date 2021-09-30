<div class="app-header header-shadow">

    <div class="app-header__logo">
        <img class="logo__mobile" style="width: 35%" src="{{ asset('img/KMTI.png') }}" alt="">
        <div class="header__pane">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>

    <div style="font-weight: bold">
        KELUARGA MAHASISWA TEKNOLOGI INFORMASI
    </div>

    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>

    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>

    <div class="app-header__content">
        <div class="app-header-right">

            {{-- <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="Type to search">
                    <button class="search-icon"><span></span></button>
                </div>
                <button class="close"></button>
            </div> --}}

            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">

                        <div class="widget-content-left">
                            <div class="btn-group" style="position: relative;">
                                
                                @if ( Auth::user()->notifs()->where('info_mahasiswa.status', 'active')->count() > 0)
                                    
                                    <a href="{{ route('user.info') }}" style="color: #3ac47d" class="p-0 btn">
                                        <i class="fa fa-bell" ></i>
                                        <span style="position: absolute; top: -10px; left: 9px;">{{ Auth::user()->notifs()->where('info_mahasiswa.status', 'active')->count() }}+</span>
                                    </a>

                                @else
                                    
                                    <i class="fa fa-bell" aria-hidden="true"></i>

                                @endif

                                
                            </div>
                        </div>

                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                                <ul class="navbar-nav ml-auto">
                                    <!-- Authentication Links -->

                                    <div class="widget-content-left  ml-3 header-user-info">
                                        <div class="widget-heading">

                                              @guest
                                                @if (Route::has('login'))

                                                    <a class="nav-link"
                                                        href="{{ route('login') }}">{{ __('Login') }}</a>

                                                @endif

                                                @if (Route::has('register'))

                                                    <a class="nav-link"
                                                        href="{{ route('register') }}">{{ __('Register') }}</a>

                                                @endif
                                            @else

                                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                                {{ Auth::user()->roles == '["mahasiswa"]' ? Auth::user()->mahasiswa->name : '' }}
                                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right mt-4">
                                                <ul class="vertical-nav-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            <span >LOGOUT</span>
                                                        </a>
                                    
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>

                                            @endguest

                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
