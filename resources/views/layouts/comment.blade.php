<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ebihaze') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
    <form action="{{route('post.comments')}}" method="post" enctype="multipart/form-data">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top globalheaderbar">
            <div class="container globalheaderbar-container">
                <div class="navbar-header globalheaderbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-left globalheaderbar-left" href="{{ $route['url'] }}">
                        ＜
                        {{--<small>{{$route['title']}}</small>--}}
                    </a>
                    <a class="navbar-brand globalheaderbar-brand" href="#">
                        {{ $title }}
                        {{--                        {{ config('app.name', 'Laravel') }}--}}
                    </a>
                    <a class="navbar-right globalheaderbar-right" href="#">
                    {{--<img src="{{asset('img/nav_flag.png')}}" alt="カレンダー"><br>--}}
                    {{--<small>カレンダー</small>--}}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div id="container">
            @yield('content')
        </div>
            <div class="c-comments_submit_container">
                <div class="c-btn-area__xsmall">
                    <button style="margin:0;" class="c-btn c-btn--blue action" data-method="file-comment">+</button>
                    <input type="file" name="comment_image">
                </div>
                <input type="text" class="c-comments_submit_text" name="body" id="required">
                <figure class="c-comments_submit_btn action" data-method="post">
                    <img src="{{asset('img/up_arrow_bubble.png')}}" alt="送信ボタン">
                </figure>
            </div>
    </div>
    </form>

    <!-- Scripts -->
    <script src="{{ asset('js/form.js') }}"></script>
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
</body>
</html>
