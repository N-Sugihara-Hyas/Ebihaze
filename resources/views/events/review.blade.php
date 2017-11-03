@extends('layouts.globalcomment')

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
                @if($event->approval && $rate!=$num)
                <th><input type="radio" name="rank_rate" id="rank0{{$num}}" class="c-radio-input" value="{{$num}}" disabled="disabled"><label for="rank0{{$num}}">&nbsp;</label></th>
                @elseif($event->approval && $rate==$num)
                <th><input type="radio" name="rank_rate" id="rank0{{$num}}" class="c-radio-input" value="{{$num}}" checked="checked"><label for="rank0{{$num}}">&nbsp;</label></th>
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
        <textarea name="event_message" class="c-input--medium"></textarea>
        </section>
        <section class="event-review__submit">
            <button class="c-btn c-btn--large c-btn--orange action" data-method="post">完了承認</button>
        </section>
        @endif
        <section class="event-review__main">
            <div class="event-review__header">
                <h1 class="event-review__title">{{$event->title}}</h1>
                <p class="event-review__notes">{{$event->updated_at}}更新</p>
            </div>
            <div class="event-review__body">
                <p class="event-review__schedule">{{date('m月d日 H:i〜', strtotime($event->schedule))}}</p>
                <p class="event-review__suppliers">{{$event->suppliers}}/{{$event->suppliers}}</p>
                <p class="event-review__parties">{{$event->parties}}/{{$event->parties}}</p>
                <p class="event-review__message">
                    {{$event->document}}
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
