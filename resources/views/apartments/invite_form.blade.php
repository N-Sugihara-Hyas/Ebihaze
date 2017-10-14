@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <form action="">
        <div class="users-invite_form">
            <div class="users-invite_form__introduction">
                <p class="users-invite_form__text">
                    新しいユーザーを招待します<br>
                    下記フォームに電話番号を正しく入力してください<br>
                    招待メッセージをお送りいたします
                </p>
            </div>
            <div class="users-invite_form__form">
                <input type="text" maxlength="13">
            </div>
            <div class="users-invite_form__submit">
                <button class="c-btn c-btn--large c-btn--blue">送信</button>
            </div>
        </div>
    </form>
</div>
@endsection
