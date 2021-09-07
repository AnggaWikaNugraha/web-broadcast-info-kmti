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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    @stack('script')
</body>

</html>
