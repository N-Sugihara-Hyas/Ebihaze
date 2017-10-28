<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
    <div id="app">

        <div id="container-menu">
            @yield('content')
        </div>

        <nav class="navbar navbar-default navbar-static-bottom">
            {{--<div class="container">--}}
                <div class="navbar-emergencycontact">
                    <button class="c-btn--max c-btn--red">送信</button>
                </div>
            {{--</div>--}}
        </nav>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/form.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
