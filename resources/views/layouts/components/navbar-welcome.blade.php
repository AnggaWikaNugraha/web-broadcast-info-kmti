<div class="app-header header-shadow" style="background-color: #004029">
    <img class="logo__mobile ml-5" style="width: 80px" src="{{ asset('img/KMTI.png') }}" alt="">

    <div class="ml-2" style="font-weight: bold; color: white">
        KELUARGA MAHASISWA TEKNOLOGI INFORMASI
    </div>

    <div class="app-header__content">
        <div class="app-header-right">

            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                                <ul class="navbar-nav ml-auto mr-5">
                                    <!-- Authentication Links -->

                                    <div class="widget-heading">

                                        @guest
                                            @if (Route::has('login'))

                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>

                                            @endif

                                        @else

                                        {!! Auth::user()->roles == 'superadmin' ? ' <a style="color: white" class="nav-link" href="admin/dashboard">Dashboard</a>' : '' !!}
                                        {!! Auth::user()->roles == 'admin' ? '<a style="color: white" class="nav-link" href="admin/dashboard">Dashboard</a>' : '' !!}
                                        {!! Auth::user()->roles == 'mahasiswa' ? '<a style="color: white" class="nav-link" href="user/dashboard">Dashboard</a>' : '' !!}

                                        @endguest

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
