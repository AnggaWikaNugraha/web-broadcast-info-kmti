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

    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    @stack('script')
</body>

</html>
