@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <form action="">
        <div class="contact_form">
            <div class="contact_form__introduction">
                <p class="contact_form__text">
                    ご返信内容とご連絡先メールアドレスを入力の上<br>
                    送信をお願いいたします
                </p>
            </div>
            <div class="contact_form__form">
                <input type="text" maxlength="13">
            </div>
            <div class="contact_form__form">
                <p>ご連絡先メールアドレス</p>
                <textarea class="c-textarea">
                </textarea>
            </div>
            <div class="contact_form__submit">
                <button class="c-btn c-btn--large c-btn--darkblue">送信</button>
            </div>
        </div>
    </form>
</div>
@endsection
