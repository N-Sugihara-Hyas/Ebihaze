@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <div class="event-review">
        <section class="event-review__introduction">
            <p>案件が完了しました。<br>
                今回の案件はいかがでしたか?<br>
                案件の結果を評価しましょう。
            </p>
        </section>
        <table class="event-review__rank">
            <tr>
                <th><input type="radio" name="rank" id="rank01" class="c-radio-input"><label for="rank01">&nbsp;</label></th>
                <th><input type="radio" name="rank" id="rank02" class="c-radio-input"><label for="rank02">&nbsp;</label></th>
                <th><input type="radio" name="rank" id="rank03" class="c-radio-input"><label for="rank03">&nbsp;</label></th>
                <th><input type="radio" name="rank" id="rank04" class="c-radio-input"><label for="rank04">&nbsp;</label></th>
                <th><input type="radio" name="rank" id="rank05" class="c-radio-input"><label for="rank05">&nbsp;</label></th>
            </tr>
            <tr>
                <td>不満</td>
                <td>やや不満</td>
                <td>普通</td>
                <td>やや満足</td>
                <td>満足</td>
            </tr>
        </table>
        <section class="event-review__comment">
            <textarea class="c-input--large"></textarea>
        </section>
        <section class="event-review__submit">
            <button class="c-btn c-btn--large c-btn--orange">完了承認</button>
        </section>
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

    </div>
</div>
@endsection
