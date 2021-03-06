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
        <nav class="navbar navbar-default navbar-static-top globalheaderbar">
            <div class="container globalheaderbar-container">
                <div class="navbar-header globalheaderbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-left globalheaderbar-left" href="{{ $route['url'] }}">
                        ＜
                        {{--<small>{{$route['title']}}</small>--}}
                    </a>
                    <a class="navbar-brand globalheader-brand" href="#">
                        {{ $title }}
{{--                        {{ config('app.name', 'Laravel') }}--}}
                    </a>
                    @if(Auth::id()==$event->etc)
                    <a class="navbar-right globalheader-right" href="{{route('events-edit', $event->id)}}">
                        {{--<img src="{{asset('img/nav_flag.png')}}" alt="カレンダー"><br>--}}
                        {{--<small>カレンダー</small>--}}
                        <span style="display:inline-block;line-height:38px;">編集</span>
                    </a>
                    @endif
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
                <a href="{{route('events-message', $event->id)}}">
                    <button class="c-btn--max c-btn--blue">コメント</button>
                </a>
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
