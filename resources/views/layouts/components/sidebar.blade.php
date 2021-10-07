<div class="app-sidebar sidebar-shadow" style="background-color: #354052">

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
                    <a  href="{{ route('dashboard') }}"
                        class="{{ Request::routeIs('dashboard') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>

                <li style="   border-bottom: 2px solid rgba(0, 0, 0, 0.125);"></li>

                <li class="app-sidebar__heading">Data Angkatan</li>
                <li>
                    <a  href="{{ route('manage-users.index') }}"
                        class="{{ Request::routeIs('manage-users.index') || Request::routeIs('manage-users.edit') || Request::routeIs('manage-users.show') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon"></i>
                        Daftar Angkatan
                    </a>
                </li>
                <li>
                    <a  href=" {{ route('manage-users.create') }}"
                        class="{{ Request::routeIs('manage-users.create') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon">
                        </i>Buat User
                    </a>
                </li>

                <li style="   border-bottom: 2px solid rgba(0, 0, 0, 0.125);"></li>

                <li class="app-sidebar__heading">Divisi</li>
                <li>
                    <a  href="{{ route('manage-divisi.index') }}"
                        class="{{ Request::routeIs('manage-divisi.index') || Request::routeIs('manage-divisi.edit') || Request::routeIs('manage-divisi.show') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon">
                        </i>List Divisi
                    </a>
                </li>
                <li>
                    <a  href="{{ route('manage-divisi.create') }}"
                        class="{{ Request::routeIs('manage-divisi.create') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon">
                        </i>Create Divisi
                    </a>
                </li>

                <li style="   border-bottom: 2px solid rgba(0, 0, 0, 0.125);"></li>

                <li class="app-sidebar__heading">Manage Event</li>
                <li>
                    <a  href="{{ route('manage-event.index') }}"
                        class="{{ Request::routeIs('manage-event.index') || Request::routeIs('manage-event.edit') || Request::routeIs('manage-event.show') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon">
                        </i>List Event
                    </a>
                </li>
                <li>
                    <a  href="{{ route('manage-event.create') }}"
                        class="{{ Request::routeIs('manage-event.create') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon">
                        </i>Create Event
                    </a>
                </li>

                <li style="   border-bottom: 2px solid rgba(0, 0, 0, 0.125);"></li>
                <li class="app-sidebar__heading">manage Info</li>
                <li>
                    <a  href="{{ route('manage-info.index') }}"
                        class="{{ Request::routeIs('manage-info.index') || 
                        Request::routeIs('manage-info.show')
                        ? 'mm-active' : '' }}">
                        <i class="metismenu-icon">
                        </i>List Info
                    </a>
                </li>
                <li>
                    <a  href="{{ route('manage-info.create') }}"
                        class="{{ Request::routeIs('manage-info.create') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon">
                        </i>Create info
                    </a>
                </li>

            </ul>
        </div>
        {{-- <div class="app-sidebar__inner wrapper__logout">
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
        </div> --}}
    </div>
</div>
