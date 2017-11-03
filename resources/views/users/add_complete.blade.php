@extends('layouts.usersheader')

@section('content')
    <div class="container">
        <div class="users-invite_form">
            <div class="users-invite_form__introduction">
                <p class="users-invite_form__text">
                    ユーザー登録しました<br>
                </p>
            </div>
            <div class="users-invite_form__submit">
                <a href="{{route('events-list')}}">
                    <button class="c-btn c-btn--large c-btn--orange">トップへ</button>
                </a>
            </div>
        </div>
    </div>
@endsection
