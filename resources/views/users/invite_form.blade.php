@extends('layouts.globalheader')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('post.users-invite-form')}}" method="post">
        {{ csrf_field() }}
        <div class="users-invite_form">
            <div class="users-invite_form__introduction">
                <p class="error" style="color:red;">{{session('error')}}</p>
                <p class="users-invite_form__text">
                    新しいユーザーを招待します<br>
                    下記フォームに電話番号を正しく入力してください<br>
                    招待メッセージをお送りいたします
                </p>
            </div>
            <div class="users-invite_form__form">
                <input type="text" name="user_tel" maxlength="13">
            </div>
            <div class="users-invite_form__submit">
                <button class="c-btn c-btn--large c-btn--blue action" data-method="post">送信</button>
            </div>
        </div>
    </form>
</div>
@endsection
