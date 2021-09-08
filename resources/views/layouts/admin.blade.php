<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.components.head')
</head>

<body>

    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

            @include('layouts.components.navbar')

            <div class="app-main">

                @include('layouts.components.sidebar')

                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card p-4">

                                    @include('layouts.components.flash-message')

                                    @yield('content')

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>

    @include('layouts.components.file-script')
    @stack('script')
</body>

</html>
