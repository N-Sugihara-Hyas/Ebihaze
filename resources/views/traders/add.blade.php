@extends('layouts.globalmenu')

@section('content')
<div class="container" id="event-form">
    <h1>案件登録</h1>
    <form action="">
        @foreach([0,1,2,3,4,5] as $list)
        <dl class="event-form">
            <dt class="event-form__title">
                タイトル
            </dt>
            <dd class="event-form__input">
                <input type="text">
            </dd>
        </dl>
        @endforeach

        <section class="c-btn-area">
            <div class="c-btn-area__large">
                <button class="c-btn c-btn--large c-btn--blue">画像登録</button>
            </div>
            <div class="c-btn-area__small">
                <button class="c-btn c-btn--small c-btn--white">キャンセル</button>
                <button class="c-btn c-btn--small c-btn--blue">登録</button>
            </div>
        </section>

    </form>
</div>
@endsection
