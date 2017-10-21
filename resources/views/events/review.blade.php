@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <div class="event-review">
        <form method="post" action="{{route('post.events-review', $event->id)}}">
        {{ csrf_field() }}
        <section class="event-review__introduction">
            <p>案件が完了しました。<br>
                今回の案件はいかがでしたか?<br>
                案件の結果を評価しましょう。
            </p>
        </section>
        <table class="event-review__rank">
            <tr>
                @foreach([1,2,3,4,5] as $num)
                @if($rate==$num)
                <th><input type="radio" name="rank_rate" id="rank0{{$num}}" class="c-radio-input" value="{{$num}}" checked="checked"><label for="rank0{{$num}}">&nbsp;</label></th>
                @elseif($event->approval)
                <th><input type="radio" name="rank_rate" id="rank0{{$num}}" class="c-radio-input" value="{{$num}}" disabled="disabled"><label for="rank0{{$num}}">&nbsp;</label></th>
                @else
                <th><input type="radio" name="rank_rate" id="rank0{{$num}}" class="c-radio-input" value="{{$num}}"><label for="rank0{{$num}}">&nbsp;</label></th>
                @endif
                @endforeach
            </tr>
            <tr>
                <td>不満</td>
                <td>やや不満</td>
                <td>普通</td>
                <td>やや満足</td>
                <td>満足</td>
            </tr>
        </table>
        @if($event->approval)
        <section class="event-review__submit">
            <p>{{$event->message}}</p>
        </section>
        @else
        <section class="event-review__comment">
        <textarea name="event_message" class="c-input--large"></textarea>
        </section>
        <section class="event-review__submit">
            <button class="c-btn c-btn--large c-btn--orange action" data-method="post">完了承認</button>
        </section>
        @endif
        <section class="event-review__main">
            <div class="event-review__header">
                <h1 class="event-review__title">エントランス掃除</h1>
                <p class="event-review__notes">2017年4月10日 12:35更新</p>
            </div>
            <div class="event-review__body">
                <p class="event-review__schedule">5月15日 10:00〜 5月15日 15:00</p>
                <p class="event-review__suppliers">業者名/業者名</p>
                <p class="event-review__parties">関係者名/関係者名</p>
                <p class="event-review__message">ここにはテキストメッセージが入ります。注意点やこれを見た方へのメッセージなどが入ります。<br>
                    ただ、マンションに居住されている方へのメッセージ
                    やその時に注意する点などが書かれる想定です。
                </p>
                <figure class="event-review__picture">
                    <img width="100%" src="{{asset('img/detail_pic.png')}}" alt="案件画像">
                </figure>
            </div>
        </section>

        </form>
    </div>
</div>
@endsection
