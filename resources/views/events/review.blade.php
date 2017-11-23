@extends('layouts.globalcomment')

@section('content')
<div class="container">
    <div id="modal-content-img">
        <figure>
            <img width="100%" src="{{asset('img/resources/event/'.$event->id.'/thumb')}}" alt="">
        </figure>
    </div>
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
                <p class="event-review__schedule">{{date('m月d日 H:i', strtotime($event->schedule))}}〜{{date('m月d日 H:i', strtotime($event->schedule_end))}}</p>
                <p class="event-review__suppliers">{{$event->suppliers}}</p>
                <p class="event-review__parties">{{$event->parties}}</p>
                <p class="event-review__message">
                    {{$event->content}}
                </p>
                <figure id="modal-open-img" class="event-review__picture">
                    <img width="100%" src="{{asset('img/resources/event/'.$event->id.'/thumb')}}" alt="案件画像">
                </figure>
            </div>
        </section>

        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function() {
        // イベント登録
        $("#modal-open-img").click(function (t) {
            t.preventDefault();
            $(this).blur(); //ボタンからフォーカスを外す
            if ($("#modal-overlay")[0]) return false; //新しくモーダルウィンドウを起動しない
            //オーバーレイ用のHTMLコードを、[body]内の最後に生成する
            $("#container").append('<div id="modal-overlay"></div>');
            // img Src を動的に変更
            var flyer_id = $(this).data('id');
            $('[name=flyer_id]').val(flyer_id);
            $('#modal-target-img').attr('src', "{{asset('img/resources/flyer')}}"+"/"+flyer_id);

            //[$modal-overlay]をフェードインさせる
            $("#modal-overlay").fadeIn("slow");
            $("#modal-content-img").fadeIn("slow");
            $('#container').css({'overflow': 'hidden'});
            $("#modal-overlay,#modal-close,#modal-close-img").unbind().click(function (t) {
                t.preventDefault();
                //[#modal-overlay]と[#modal-close]をフェードアウトする
                $("#modal-content-img,#modal-overlay").fadeOut("slow", function () {
                    //フェードアウト後、[#modal-overlay]をHTML(DOM)上から削除
                    $("#modal-overlay").remove();
                });
                $('#container').css({'overflow': 'visible'});
            });
        });
    });
</script>
@endsection
