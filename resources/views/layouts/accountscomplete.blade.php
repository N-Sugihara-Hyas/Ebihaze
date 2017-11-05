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
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{--<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" >--}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-left" href="{{ $route['url'] }}">
                        ＜ <small>{{$route['title']}}</small>
                    </a>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ $title }}
                        {{--                        {{ config('app.name', 'Laravel') }}--}}
                    </a>
                    {{--<a class="navbar-right" href="{{route('events-search') }}">--}}
                    {{--<img src="{{asset('img/nav_flag.png')}}" alt="カレンダー"><br>--}}
                    {{--<small>カレンダー</small>--}}
                    {{--</a>--}}
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
                <div class="navbar-accountscomplete">
                    <button class="c-btn--max c-btn--blue action" data-method="post">完了</button>
                </div>
            {{--</div>--}}
        </nav>
    </div>

    <!-- Scripts -->
    @section('scripts')
    @show
    <script src="{{ asset('js/form.js') }}"></script>
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
</body>
</html>
