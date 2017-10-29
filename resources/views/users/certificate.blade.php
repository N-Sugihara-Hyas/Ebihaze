@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <form action="{{route('post.users-certificate')}}" method="post">
        {{ csrf_field() }}
        <div class="users-invite_form">
            <div class="users-invite_form__introduction">
                <p class="users-invite_form__text">
                    SMSに送信されたコードの<br>
                    入力をお願いします。<br>
                    SMSで発行されたコードの<br>
                    有効期限は24時間です<br>
                </p>
            </div>
            <div class="users-invite_form__form">
                <input name="user_auth_token" type="text" maxlength="13">
                <input name="user_id" type="hidden" value="{{$user->id}}">
                <input name="user_type" type="hidden" value="officer">
            </div>
            <div class="users-invite_form__submit">
                <button class="c-btn c-btn--large c-btn--blue action" data-method="post">送信</button>
            </div>
        </div>
    </form>
</div>
@endsection
