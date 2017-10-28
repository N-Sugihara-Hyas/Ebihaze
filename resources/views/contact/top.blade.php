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
            <div class="contact_form__textarea">
                <textarea class="c-textarea" rows="5" placeholder="お問い合わせ内容をご入力ください">
                </textarea>
            </div>
            <div class="contact_form__form">
                <p>ご連絡先メールアドレス</p>
                <input type="text" maxlength="13" placeholder="aaa@bbb.jp">
            </div>
            <div class="contact_form__submit">
                <button class="c-btn--max c-btn--darkblue">送信</button>
            </div>
        </div>
    </form>
</div>
@endsection
