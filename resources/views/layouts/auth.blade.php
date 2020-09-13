<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">

    <style>
    .btn-group-xs > .btn, .btn-xs {
        padding: .25rem .4rem;
        font-size: .875rem;
        line-height: .5;
        border-radius: .2rem;
    }
    body { padding-top: 70px; }

    html {
        position: relative;
        min-height: 100%;
    }

    body {
        margin-bottom: 60px; /* Margin bottom by footer height */
    }

    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 50px; /* Set the fixed height of the footer here */
        line-height: 50px; /* Vertically center the text there */
        background-color: #343a40;
        color:#ffffff;
    }

    </style>

    @yield('css')
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>


@yield('js')
</body>
</html>
