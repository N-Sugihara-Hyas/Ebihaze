@extends('layouts.emergencycontact')

@section('content')
    <div class="container">
        <ul class="menu-list c-menu c-list">
            <li class="c-menu__item c-list__item">
                <div class="menu-header">
                    <section class="menu-header__thumb">
                        <figure>
                            <img class="c-circle" src="{{asset('img/resources/user/'.Auth::id().'/icon')}}" alt="">
                        </figure>
                    </section>
                    <section class="menu-header__title">
                        <p>　{{Auth::user()->nickname}}</p>
                    </section>
                </div>
            </li>
        </ul>

        <ul class="menu-list c-menu c-list">
            <a href="{{route('events-add')}}">
                <li class="menu-list__item c-menu__item c-list__item">
                    <div class="menu-item-container">
                        <section class="menu-item-title">
                            <p>
                                案件登録
                            </p>
                        </section>
                    </div>
                </li>
            </a>
            @if(Auth::user()->type=='officer')
            <a href="{{route('traders-list')}}">
                <li class="menu-list__item c-menu__item c-list__item">
                    <div class="menu-item-container">
                        <section class="menu-item-title">
                            <p>
                                業者一覧/登録
                            </p>
                        </section>
                    </div>
                </li>
            </a>
            @endif
        </ul>
        <h2 class="menu-list__title">ユーザー</h2>
        <ul class="menu-list c-menu c-list">
            <a href="{{route('users-list',1)}}">
                <li class="menu-list__item c-menu__item c-list__item">
                    <div class="menu-item-container">
                        <section class="menu-item-title">
                            <p>
                                ユーザー一覧
                            </p>
                        </section>
                    </div>
                </li>
            </a>
            <a href="{{route('users-invite-form')}}">
                <li class="menu-list__item c-menu__item c-list__item">
                    <div class="menu-item-container">
                        <section class="menu-item-title">
                            <p>
                                ユーザー招待
                            </p>
                        </section>
                    </div>
                </li>
            </a>
        </ul>
        @if(Auth::user()->type=='officer')
        <h2 class="menu-list__title">マンション</h2>
        <ul class="menu-list c-menu c-list">
            <a href="{{route('apartments-detail', session('apartment_id'))}}">
                <li class="menu-list__item c-menu__item c-list__item">
                    <div class="menu-item-container">
                        <section class="menu-item-title">
                            <p>
                                マンション情報表示
                            </p>
                        </section>
                    </div>
                </li>
            </a>
            @if(Auth::user()->membership==1)
            <a href="{{route('apartments-rank')}}">
                <li class="menu-list__item c-menu__item c-list__item">
                    <div class="menu-item-container">
                        <section class="menu-item-title">
                            <p>
                                マンションランク表示
                            </p>
                        </section>
                    </div>
                </li>
            </a>
            @else
            <a href="{{route('apartments-list')}}">
                <li class="menu-list__item c-menu__item c-list__item">
                    <div class="menu-item-container">
                        <section class="menu-item-title">
                            <p>
                                マンション一覧
                            </p>
                        </section>
                    </div>
                </li>
            </a>
            @endif
            <a href="{{route('accounts-list')}}">
                <li class="menu-list__item c-menu__item c-list__item">
                    <div class="menu-item-container">
                        <section class="menu-item-title">
                            <p>
                                口座残高
                            </p>
                        </section>
                    </div>
                </li>
            </a>
            <a href="{{route('apartments-switch')}}">
                <li class="menu-list__item c-menu__item c-list__item">
                    <div class="menu-item-container">
                        <section class="menu-item-title">
                            <p>
                                マンションを切り替える
                            </p>
                        </section>
                    </div>
                </li>
            </a>
        </ul>
        @endif
        <ul class="menu-list c-menu c-list">
            <a href="{{route('contacts-top')}}">
                <li class="menu-list__item c-menu__item c-list__item">
                    <div class="menu-item-container">
                        <section class="menu-item-title">
                            <p>
                                お問い合わせ
                            </p>
                        </section>
                    </div>
                </li>
            </a>
            <a href="{{route('statics-privacy')}}">
                <li class="menu-list__item c-menu__item c-list__item">
                    <div class="menu-item-container">
                        <section class="menu-item-title">
                            <p>
                                プライバシポリシー
                            </p>
                        </section>
                    </div>
                </li>
            </a>
            <a href="{{route('statics-terms')}}">
                <li class="menu-list__item c-menu__item c-list__item">
                    <div class="menu-item-container">
                        <section class="menu-item-title">
                            <p>
                                ご利用規約
                            </p>
                        </section>
                    </div>
                </li>
            </a>
        </ul>
    </div>
@endsection
