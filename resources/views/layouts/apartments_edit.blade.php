<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top apartmentheaderbar">
            <div class="container">
                <div class="navbar-header apartmentheaderbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-left apartmentheaderbar-left" href="{{ $route['url'] }}">
                        ＜
                        {{--<small>{{$route['title']}}</small>--}}
                    </a>
                    <a class="navbar-brand apartmentheaderbar-brand" href="#">
                        {{ $title }}
                        {{--                        {{ config('app.name', 'Laravel') }}--}}
                    </a>
                    <a class="navbar-right apartmentheaderbar-right" href="#">
                    {{--<img src="{{asset('img/nav_flag.png')}}" alt="カレンダー"><br>--}}
                    {{--<small>カレンダー</small>--}}
                    </a>
                </div>
                {{--<div class="navbar-footer">--}}
                {{--<ul class="navbar-footer__list">--}}
                {{--<a class="navbar-footer__tab navbar-footer--list navbar-footer__tab--active" href="{{route('events-list')}}">--}}
                {{--<li>案件一覧</li>--}}
                {{--</a>--}}
                {{--<a class="navbar-footer__tab navbar-footer--join" href="{{route('events-join')}}">--}}
                {{--<li>参加一覧</li>--}}
                {{--</a>--}}
                {{--<a class="navbar-footer__tab navbar-footer--watch" href="{{route('events-watch')}}">--}}
                {{--<li>ウォッチ一覧</li>--}}
                {{--</a>--}}
                {{--</ul>--}}
                {{--</div>--}}
            </div>
        </nav>

        <div id="container">
            @yield('content')
        </div>

        <nav class="navbar navbar-default navbar-static-bottom">
            {{--<div class="container">--}}
            <div class="navbar-globalcomment">
                <a href="{{route('apartments-edit', $apartment->id)}}">
                    <button class="c-btn--max c-btn--blue">情報編集</button>
                </a>
            </div>
            {{--</div>--}}
        </nav>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/form.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
