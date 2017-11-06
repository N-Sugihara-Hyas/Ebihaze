@extends('layouts.globalheader')

@section('content')
<div class="container hidden">
    <section id="modal-content-img">
        <form action="{{route('post.flyers-list')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="flyer_id">
            <figure>
                <img id="modal-target-img" src="" alt="">
            </figure>
        </form>
    </section>

    <section class="flyers-mv">
        <ul class="flyers-mv-list slick-slider">
            @foreach($flyers as $flyer)
            <li data-id="{{$flyer->id}}" class="modal-open-img">
                <img src="{{asset("img/resources/flyer/$flyer->id")}}" alt="">
            </li>
            @endforeach
        </ul>
    </section>
    <ul class="flyers-list c-list" style="margin-top:30px;">
        <form action="{{route('post.flyers-list')}}" method="post">{{csrf_field()}}</form>
    </ul>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.slick-slider').slick({
                infinite: true
            });
            $('.hidden').removeClass('hidden');
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