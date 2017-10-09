@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <div class="event-detail">
        <section class="event-detail__header">
            <h1 class="event-detail__title">エントランス掃除</h1>
            <p class="event-detail__notes">2017年4月10日 12:35更新</p>
        </section>
        <section class="event-detail__body">
            <p class="event-detail__schedule">5月15日 10:00〜 5月15日 15:00</p>
            <p class="event-detail__suppliers">業者名/業者名</p>
            <p class="event-detail__parties">関係者名/関係者名</p>
            <p class="event-detail__message">ここにはテキストメッセージが入ります。注意点やこれを見た方へのメッセージなどが入ります。<br>
                ただ、マンションに居住されている方へのメッセージ
                やその時に注意する点などが書かれる想定です。
            </p>
            <figure class="event-detail__picture">
                <img width="100%" src="{{asset('img/detail_pic.png')}}" alt="案件画像">
            </figure>
        </section>
        <section class="event-detail__footer">
            <div class="c-btn-area__large">
                <button class="c-btn c-btn--small c-btn--blue">完了</button>
            </div>
        </section>
    </div>
</div>
@endsection
