<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ebihaze') }}</title>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- BxSlider -->
    <link rel="stylesheet" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick-theme.css')}}">
    <script src="{{asset('js/slick.min.js')}}"></script>
    <style>
        .slick-prev:before{
            content: '';
        }
        .slick-prev{
            border-top: 14px solid transparent;
            border-left: 14px solid transparent;
            border-right: 20px solid rgba(60,60,60,100);
            border-bottom: 14px solid transparent;
            z-index: 2;
        }
        .slick-next:before {
            content: '';
        }
        .slick-next{
            border-top: 14px solid transparent;
            border-left: 20px solid rgba(60,60,60,100);
            border-right: 14px solid transparent;
            border-bottom: 14px solid transparent;
            z-index: 2;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top globalheaderbar">
            <div class="container">
                <div class="navbar-header globalheaderbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-left globalheaderbar-left" href="{{ $route['url'] }}">
                        ＜ {{--<span>{{$route['title']}}</span>--}}
                    </a>
                    <a class="navbar-brand globalheader-brand" href="#">
                        {{ $title }}
{{--                        {{ config('app.name', 'Laravel') }}--}}
                    </a>
                    <a class="navbar-right globalheader-right" href="#">
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
            <div class="container">
                <div class="navbar-footer">
                    <ul class="navbar-footer__list">
                        <a class="navbar-footer__tab navbar-footer--list" href="{{route('statics-menu')}}">
                            <li>
                                <img src="{{asset('img/nav_menu.png')}}" alt="ナビメニュー"><br>メニュー
                            </li>
                        </a>
                        <a class="navbar-footer__tab navbar-footer--join" href="{{route('apartments-rank')}}">
                            <li>
                                <img src="{{asset('img/nav_rank.png')}}" alt="ナビランク"><br>ランク
                            </li>
                        </a>
                        <a class="navbar-footer__tab navbar-footer--watch" href="{{route('flyers-list')}}">
                            <li>
                                <img src="{{asset('img/nav_flyer.png')}}" alt="ナビチラシ"><br>チラシ
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Scripts -->
    @section('scripts')
    @show
    <script src="{{ asset('js/form.js') }}"></script>
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
</body>
</html>
