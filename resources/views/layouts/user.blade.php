<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.components.head')
</head>

<body>

    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

            @include('user.components.navbar')

            <div class="app-main">

                @include('user.components.sidebar')

                <div class="app-main__outer">
                    <div class="app-main__inner">

                        @include('layouts.components.flash-message')

                        @yield('content')

                    </div>
                </div>
            </div>

        </div>
    </body>

    @include('layouts.components.file-script')
    @stack('script')
</body>

</html>
