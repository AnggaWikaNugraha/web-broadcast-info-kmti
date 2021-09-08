<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.components.head')
</head>

<body>

    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

            @yield('body')

        </div>
    </body>

    @include('layouts.components.file-script')
    @stack('script')
</body>

</html>
