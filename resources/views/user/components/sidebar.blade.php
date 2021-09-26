<div class="app-sidebar sidebar-shadow">

    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
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

    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner mt-4">
            <ul class="vertical-nav-menu">

                <li>
                    <a href="{{ route('user.dashboard') }}"
                        class="{{ Request::routeIs('user.dashboard') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>

                <li style="   border-bottom: 2px solid rgba(0, 0, 0, 0.125);"></li>

                <li>
                    <a href="{{ route('user.profile') }}"
                        class="{{ Request::routeIs('user.profile') || Request::routeIs('user.profile.edit') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Profile
                    </a>
                </li>

                <li style=" border-bottom: 2px solid rgba(0, 0, 0, 0.125); "></li>

                <li>
                    <a href="{{ route('user.divisi') }}"
                        class="{{ Request::routeIs('user.divisi') || Request::routeIs('user.detailDivisi')? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Divisi
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.event') }}"
                        class="{{ Request::routeIs('user.event') || Request::routeIs('user.detailEvent') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Event
                    </a>

                </li>

                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-radio"></i>
                        Info
                    </a>
                </li>

            </ul>
        </div>
        <div class="app-sidebar__inner wrapper__logout">
            <ul class="vertical-nav-menu">
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="fons__logout">LOGOUT</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
