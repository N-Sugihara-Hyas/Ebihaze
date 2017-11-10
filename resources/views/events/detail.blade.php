@extends('layouts.globalcomment')

@section('content')
<div class="container" style="position: relative">
    <div id="modal-content-img">
        <img width="100%" src="{{asset('img/resources/event/'.$event->id.'/thumb')}}" alt="案件画像">
    </div>
    <section class="c-favstar-container">
        @if($watched==1)
            <span id="fabstar" class="c-fabstar-item active" data-eventuser_event_id="{{$event->id}}" data-eventuser_user_id="{{Auth::id()}}">★</span>
        @else
            <span id="fabstar" class="c-fabstar-item" data-eventuser_event_id="{{$event->id}}" data-eventuser_user_id="{{Auth::id()}}">☆</span>
        @endif
    </section>
    <div class="event-detail">
        <section class="event-detail__header">
            <h1 class="event-detail__title">{{$event->title}}</h1>
            <p class="event-detail__notes">{{date('Y', strtotime($event->updated_at))}}年{{date('m', strtotime($event->updated_at))}}月{{date('d', strtotime($event->updated_at))}}日 {{date('H:i', strtotime($event->updated_at))}}更新</p>
        </section>
        <section class="event-detail__body">
            <p class="event-detail__schedule">{{date('m', strtotime($event->schedule))}}月{{date('d', strtotime($event->schedule))}}日 {{date('H:i', strtotime($event->schedule))}}〜 {{date('m', strtotime($event->schedule_end))}}月{{date('d', strtotime($event->schedule_end))}}日 {{date('H:i', strtotime($event->schedule_end))}}</p>
            <p class="event-detail__suppliers">{{$event->suppliers}}</p>
            <p class="event-detail__parties">{{$event->parties}}</p>
            <p class="event-detail__message">
                {{$event->content}}
            </p>
            <figure id="modal-open-img" class="event-detail__picture">
                <img width="100%" src="{{asset('img/resources/event/'.$event->id.'/thumb')}}" alt="案件画像">
            </figure>
        </section>
        @if(Auth::user()->type=='officer')
        <section class="event-detail__footer">
            <div class="c-btn-area__large">
                <a href="{{route('events-review', $event->id)}}">
                    <button class="c-btn c-btn--small c-btn--blue">完了</button>
                </a>
            </div>
        </section>
        @endif
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function(){
        $('#fabstar').on('click', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // 登録か解除か
            if($(this).hasClass('active')){
                var type = '9';//解除
            }else{
                var type = '1';// 登録
            }
            $data = {
                'event_id' : $(this).data('eventuser_event_id'),
                'user_id' : $(this).data('eventuser_user_id'),
                'watched' : type
            };
            $.ajax({
                type: "POST",
                url: "{{route('events-eventuser')}}",
                data: $data,
                dataType: 'json',
                async : false
            }).done(function(data, res){
                if(type=='1'){
                    $('#fabstar').text('★');
                    $('#fabstar').addClass('active');
                                }else{
                    $('#fabstar').text('☆');
                    $('#fabstar').removeClass('active');
                }
                return false;
            }).fail(function(XMLHttpRequest, textStatus, errorThrown){
console.log(XMLHttpRequest)
console.log(textStatus)
console.log(errorThrown)
                alert('登録できませんでした')
                return false;
            })
        })
    })
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