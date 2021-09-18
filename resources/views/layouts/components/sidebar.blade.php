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
                    <a href="{{ route('dashboard') }}" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-add-user"></i>
                        Data Angkatan
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('manage-users.index') }}">
                                <i class="metismenu-icon"></i>
                                Daftar Angkatan
                            </a>
                        </li>
                        <li>
                            <a href=" {{ route('manage-users.create') }}">
                                <i class="metismenu-icon">
                                </i>Buat User
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-radio"></i>
                        Data Angkatan
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('manage-mahasiswa.index') }}">
                                <i class="metismenu-icon">
                                </i>List Mahasiswa
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-mahasiswa.create') }}">
                                <i class="metismenu-icon">
                                </i>Create Mahasiswa
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Divisi
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('manage-divisi.index')}}">
                                <i class="metismenu-icon">
                                </i>List Divisi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-divisi.create')}}">
                                <i class="metismenu-icon">
                                </i>Create Divisi
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Manage Event
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('manage-event.index') }}">
                                <i class="metismenu-icon">
                                </i>List Event
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-event.create') }}">
                                <i class="metismenu-icon">
                                </i>Create Event
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-radio"></i>
                        Info
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('manage-info.index')  }}">
                                <i class="metismenu-icon">
                                </i>List Info
                            </a>
                        </li>
                        <li>
                            <a href="components-accordions.html">
                                <i class="metismenu-icon">
                                </i>Create info
                            </a>
                        </li>
                    </ul>
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
