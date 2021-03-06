<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ebihaze') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top tradersheaderbar">
            <div class="container tradersheaderbar-container">
                <div class="navbar-header tradersheaderbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-left tradersheaderbar-left" href="{{ $route['url'] }}">
                        ＜
                        {{--<small>{{$route['title']}}</small>--}}
                    </a>
                    <a class="navbar-brand tradersheaderbar-brand" href="#">
                        {{ $title }}
                    </a>
                    <a class="navbar-right tradersheaderbar-right" href="#">
                    </a>
                </div>
            </div>
        </nav>

        <div id="container">
            @yield('content')
        </div>

        <nav class="navbar navbar-default navbar-static-bottom">
            {{--<div class="container">--}}
            @if(Auth::user()->type!='trader'||$trader->user_id==Auth::id())
            <div class="navbar-globalcomment">
                <a href="{{route('traders-edit', $trader->id)}}">
                    <button class="c-btn--max c-btn--blue">情報編集</button>
                </a>
            </div>
            @endif
            {{--</div>--}}
        </nav>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/form.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
