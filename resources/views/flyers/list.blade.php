@extends('layouts.globalheader')

@section('content')
<div class="container">
    <section id="modal-content-img">
        <form action="{{route('post.flyers-list')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="flyer_id">
            <figure>
                <img id="modal-target-img" src="" alt="">
            </figure>
            <div class="" style="text-align: center;margin-top:15px;">
                <button class="c-btn--small c-btn--skyblue">保存</button>
            </div>
        </form>
    </section>

    <section class="flyers-mv">
        <ul class="flyers-mv-list slick-slider">
            @foreach($flyers as $flyer)
            <li data-id="{{$flyer->id}}" class="modal-open-img">
                {{--<img src="{{asset('img/resources/flyer').'/'.$flyer->id.'.png'}}" alt="">--}}
                <img src="{{asset("img/resources/flyer/$flyer->id")}}" alt="">
            </li>
            @endforeach
        </ul>
    </section>
    <ul class="flyers-list c-list">
        <form action="{{route('post.flyers-list')}}" method="post">{{csrf_field()}}</form>
        <li class="flyers-list__item c-list__item">
            <div class="flyers-item-container">
                <section class="flyers-item-main">
                    <p class="flyers-item-title">
                        保存したチラシ
                    </p>
                </section>
            </div>
        </li>
    </ul>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.slick-slider').slick({
                infinite: true
            });
        });
    </script>
    <script>
        $(function() {
            // イベント登録
            $(".modal-open-img").click(function (t) {
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