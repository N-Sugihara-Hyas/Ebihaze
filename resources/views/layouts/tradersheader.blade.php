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
        <nav class="navbar navbar-default navbar-static-top tradersheaderbar">
            <div class="container">
                <div class="navbar-header tradersheaderbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-left tradersheaderbar-left" href="{{ $route['url'] }}">
                        ＜
                        {{--<small>{{$route['title']}}</small>--}}
                    </a>
                    <a class="navbar-brand tradersheaderbar-brand" href="#">
                        {{ $title }}
                    </a>
                    <a class="navbar-right tradersheaderbar-right" href="{{route('traders-add') }}">
                        ＋<br>
                        <small>追加</small>
                    </a>
                </div>
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
                        <a class="navbar-footer__tab navbar-footer--list" href="{{route('events-list')}}">
                            <li>
                                <img src="" alt="(画像アイコン)"><br>案件一覧
                            </li>
                        </a>
                        @if(Auth::user()->type=='officer'||Auth::user()->type=='app')
                        <a class="navbar-footer__tab navbar-footer--join" href="{{route('apartments-rank')}}">
                            <li>
                                <img src="{{asset('img/nav_rank.png')}}" alt="ナビランク"><br>ランク
                            </li>
                        </a>
                        @endif
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
