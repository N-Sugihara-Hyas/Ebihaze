@extends('layouts.usersheader')

@section('content')
<div class="container">
    <form action="{{route('post.users-create')}}" method="post">
        {{ csrf_field() }}
        <div class="users-invite_form">
            <div class="users-invite_form__introduction">
                <p class="error" style="color:red;">{{session('error')}}</p>
                <p class="users-invite_form__text">
                    ユーザー登録を行います<br>
                    SMSの番号を<br>
                    入力してください<br>
                    送信後SMSが届きますので<br>
                    SMSに記載のIDを入力の上<br>
                    ユーザー情報入力にお進み下さい<br>
                </p>
            </div>
            <div class="users-invite_form__form">
                <input name="user_tel" type="text" maxlength="13">
            </div>
            <div class="users-invite_form__submit">
                <button class="c-btn c-btn--large c-btn--blue action" data-method="post">送信</button>
            </div>
        </div>
    </form>
</div>
@endsection
