@extends('layouts.globalheader')

@section('content')
<div class="container" id="event-form">
    <div id="modal-content-traders">
        <ul class="trader-list c-list" id="trader-list">
            @foreach($traders as $trader)
                <li class="trader-list__item c-list__item {{(in_array($trader->id, explode(',', old('suppliers')))) ? 'selected' : ''}}" data-id="{{$trader->id}}" data-name="{{$trader->name}}">
                    <div class="trader-item-container">
                        <section class="trader-item-title">
                            <p>
                                {{$trader->name}}
                            </p>
                        </section>
                        <section class="trader-item-rank">
                    <span class="trader-item-rank__fav">
                        ★
                    </span>
                            <span class="trader-item-rank__score">
                        {{round($trader->rank,1)}}
                    </span>
                        </section>
                        <section class="trader-item-icon">
                            <figure>
                                <img class="c-circle" width="41px" height="41px" src="{{asset("img/resources/trader/$trader->id/icon")}}" alt="">
                            </figure>
                        </section>
                    </div>
                </li>
            @endforeach
            <div class="c-btn-area__small" style="text-align: center">
                <button class="c-btn c-btn--small c-btn--white action" style="width:44%;" data-method="cancel" id="modal-close-traders">キャンセル</button>
                <button class="c-btn c-btn--small c-btn--blue" id="done-traders" style="width:44%;" data-method="post">OK</button>
            </div>
        </ul>
    </div>
    <div id="modal-content-users">
        <ul class="users-list c-list" id="users-list">
            @foreach($users as $user)
                <li class="users-list__item c-list__item {{(in_array($user->id, explode(',', old('parties')))) ? 'selected' : ''}}" data-id="{{$user->id}}" data-name="{{$user->nickname}}">
                    <div class="users-item-container">
                        <section class="users-item-main">
                            @switch($user->type)
                            @case('officer')
                            <p class="users-item-batch c-btn c-btn--xsmall c-btn--skyblue">{{$user::$type_display[$user->type]}}</p>
                            @break
                            @case('app')
                            <p class="users-item-batch c-btn c-btn--xsmall c-btn--blue">{{$user::$type_display[$user->type]}}</p>
                            @break
                            @default
                            <p class="users-item-batch c-btn c-btn--xsmall c-btn--blue" style="visibility: hidden;">&nbsp;</p>
                            @break
                            @endswitch
                            <p class="users-item-title">
                                {{$user->nickname}}
                            </p>
                        </section>
                        <section class="users-item-icon">
                            <figure>
                                <img width="100%" src="{{asset('img/icon.png')}}" alt="">
                            </figure>
                        </section>
                    </div>
                </li>
            @endforeach
            <div class="c-btn-area__small" style="text-align: center">
                <button class="c-btn c-btn--small c-btn--white" style="width:44%;" data-method="cancel" id="modal-close-users">キャンセル</button>
                <button class="c-btn c-btn--small c-btn--blue" id="done-users" style="width:44%;" data-method="post">OK</button>
            </div>
        </ul>
    </div>
    <h1>案件登録</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{route('post.events-add')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
        <dl class="event-form">
            <dt class="event-form__title">
                タイトル
            </dt>
            <dd class="event-form__input">
                <input type="text" name="title" value="{{old('title')}}" placeholder="案件タイトル">
            </dd>
        </dl>
        <dl class="event-form">
            <dt class="event-form__title">
                開始施工日時
            </dt>
            <dd class="event-form__input">
                <div style="display:inline-block;padding-left: 5px;width:60%;">
                    <small>日時：</small><br><input style="margin-left: 1em;width:75%;" type="text" name="schedule[Ymd]" id="datepicker1" value="{{old('schedule.Ymd')}}" placeholder="選択ください">
                </div>
                <div style="display:inline-block;width:35%;">
                    <small>時間：</small><br><select name="schedule[Hi]" id="datepicker">
                        @foreach(range(0, 23) as $hour)
                            @if(empty(old('schedule.Hi')) && $hour==12)
                            <option value="{{sprintf("%02d", $hour)}}:00" selected>{{sprintf("%02d", $hour)}}:00</option>
                            <option value="{{sprintf("%02d", $hour)}}:30">{{sprintf("%02d", $hour)}}:30</option>
                            @else
                            <option value="{{sprintf("%02d", $hour)}}:00" {{(old('schedule.Hi') == sprintf("%02d", $hour).":00") ? 'selected' : ''}}>{{sprintf("%02d", $hour)}}:00</option>
                            <option value="{{sprintf("%02d", $hour)}}:30" {{(old('schedule.Hi') == sprintf("%02d", $hour).":30") ? 'selected' : ''}}>{{sprintf("%02d", $hour)}}:30</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </dd>
        </dl>
        <dl class="event-form">
            <dt class="event-form__title">
                終了施工日時
            </dt>
            <dd class="event-form__input">
                <div style="display:inline-block;padding-left: 5px;width:60%;">
                    <small>日時：</small><br><input style="margin-left: 1em;width:75%;" type="text" name="schedule_end[Ymd]" id="datepicker2" value="{{old('schedule_end.Ymd')}}" placeholder="選択ください">
                </div>
                <div style="display:inline-block;width:35%;">
                    <small>時間：</small><br><select name="schedule_end[Hi]" id="datepicker">
                        @foreach(range(0, 23) as $hour)
                            @if(empty(old('schedule_end.Hi')) && $hour==12)
                            <option value="{{sprintf("%02d", $hour)}}:00" selected>{{sprintf("%02d", $hour)}}:00</option>
                            <option value="{{sprintf("%02d", $hour)}}:30">{{sprintf("%02d", $hour)}}:30</option>
                            @else
                            <option value="{{sprintf("%02d", $hour)}}:00" {{(old('schedule.Hi') == sprintf("%02d", $hour).":00") ? 'selected' : ''}}>{{sprintf("%02d", $hour)}}:00</option>
                            <option value="{{sprintf("%02d", $hour)}}:30" {{(old('schedule.Hi') == sprintf("%02d", $hour).":30") ? 'selected' : ''}}>{{sprintf("%02d", $hour)}}:30</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </dd>
        </dl>
        <dl class="event-form">
            <dt class="event-form__title">
                種類１
            </dt>
            <dd class="event-form__input">
                <select name="category" id="category">
                    @foreach($main_category = array_keys($event::$category) as $cate)
                        <option value="{{$cate}}" {{(old('category')==$cate) ? 'selected' : ''}}>{{$cate}}</option>
                    @endforeach
                </select>
            </dd>
        </dl>
        <dl class="event-form">
            <dt class="event-form__title">
                種類２
            </dt>
            <dd class="event-form__input">
                <select name="subcategory" id="subcategory">
                    @foreach($event::$category[$main_category[0]] as $subcate)
                        <option value="{{$subcate}}" {{(old('subcategory')==$subcate) ? 'selected' : ''}}>{{$subcate}}</option>
                    @endforeach
                </select>
            </dd>
        </dl>
        <dl class="event-form">
            <dt class="event-form__title">
                業者&nbsp;
                <button style="width:auto;" class="c-btn c-btn--xsmall c-btn--skyblue" id="modal-open-traders">業者選択</button>
            </dt>
            <dd class="event-form__input">
                <p class="suppliers_name" style="min-height: 24px;">{{old('suppliers_name')}}</p>
                {{--<input type="text" name="suppliers_name" value="{{old('suppliers_name')}}">--}}
                <input class="suppliers" type="hidden" name="suppliers" value="{{old('suppliers')}}">
                <input class="suppliers_name" type="hidden" name="suppliers_name" value="{{old('suppliers_name')}}">
            </dd>
        </dl>
        <dl class="event-form">
            <dt class="event-form__title">
                内容
            </dt>
            <dd class="event-form__input">
                <input type="text" name="content" value="{{old('content')}}" placeholder="案件内容を記入ください">
            </dd>
        </dl>
        <dl class="event-form">
            <dt class="event-form__title">
                関係者&nbsp;
                <button style="width:auto;" class="c-btn c-btn--xsmall c-btn--skyblue" id="modal-open-users">関係者選択</button>
            </dt>
            <dd class="event-form__input">
                <p class="parties" style="min-height: 24px;">{{old('parties_name')}}</p>
                <input type="hidden" name="parties_name" value="{{old('parties_name')}}">
                <input class="parties" type="hidden" name="parties" value="{{old('parties')}}">
            </dd>
        </dl>

        <section class="c-btn-area">
            <div class="c-btn-area__large">
                <button class="c-btn c-btn--large c-btn--blue action" data-method="file">画像登録</button>
                <input type="file" name="event_thumb">
            </div>
            <div class="c-btn-area__small">
                <button class="c-btn c-btn--small c-btn--white action" data-method="link" data-href="{{route('events-list')}}">キャンセル</button>
                <button class="c-btn c-btn--small c-btn--blue action" data-method="post">登録</button>
            </div>
        </section>

    </form>
</div>
@endsection
@section('scripts')
    @parent
    <script>
        var category = {
            '管理業務' : ['修繕', '清掃', '保険', '町内会等', 'その他'],
            'イベント' : ['イベント'],
            '会議' : ['理事会', '総会', 'その他'],
            '共有' : ['連絡事項', 'その他'],
            'その他' : ['その他']
        };
        $(function(){
            $('#category').on('change', function(){
                cate = $('#category').val();
                subcate = category[cate];
                $('#subcategory').empty();
                $.each(subcate, function(){
                    $('#subcategory').append(
                            '<option value="'+this+'">'+this+'</option>'
                    );
                });
            });
        });
    </script>
@endsection
@section('scripts')
<script>
    $(function(){
        $('#datepicker1').datepicker();
        $('#datepicker2').datepicker();
    });
</script>
<script>
    $(function() {
        // イベント登録
        $("#modal-open-traders, p.suppliers_name").click(function (t) {
            t.preventDefault();
            $(this).blur(); //ボタンからフォーカスを外す
            if ($("#modal-overlay")[0]) return false; //新しくモーダルウィンドウを起動しない
            //オーバーレイ用のHTMLコードを、[body]内の最後に生成する
            $("#container").append('<div id="modal-overlay"></div>');
            //[$modal-overlay]をフェードインさせる
            $("#modal-overlay").fadeIn("slow");
            $("#modal-content-traders").fadeIn("slow");
            $('#container').css({'overflow': 'hidden'});
            $("#modal-overlay,#modal-close,#modal-close-traders").unbind().click(function (t) {
                t.preventDefault();
                //[#modal-overlay]と[#modal-close]をフェードアウトする
                $("#modal-content-traders,#modal-overlay").fadeOut("slow", function () {
                    //フェードアウト後、[#modal-overlay]をHTML(DOM)上から削除
                    $("#modal-overlay").remove();
                });
                $('#container').css({'overflow': 'visible'});
            });
        });
        // 業者選択
        $('#trader-list li').on('click', function(){
            if($(this).hasClass('selected')){
                $(this).removeClass('selected');
            }else{
                $(this).addClass('selected');
            }
        });
        $('#done-traders').on('click', function(t){
            t.preventDefault();
            var ids = [];
            var names = [];
            $('#trader-list .selected').each(function(){
                ids.push($(this).data('id'));
                names.push($(this).data('name'));
            });
            var id = ids.join();
            var name = names.join();
            $('input[name=suppliers]').val(id);
            $('input[name=suppliers_name]').val(name);
            $('p.suppliers_name').text(name);
            $('#modal-close-traders').trigger('click');
        });
        // 関係者選択
        $("#modal-open-users, p.parties").click(function (t) {
            t.preventDefault();
            $(this).blur(); //ボタンからフォーカスを外す
            if ($("#modal-overlay")[0]) return false; //新しくモーダルウィンドウを起動しない
            //オーバーレイ用のHTMLコードを、[body]内の最後に生成する
            $("#container").append('<div id="modal-overlay"></div>');
            //[$modal-overlay]をフェードインさせる
            $("#modal-overlay").fadeIn("slow");
            $("#modal-content-users").fadeIn("slow");
            $('#container').css({'overflow': 'hidden'});
            $("#modal-overlay,#modal-close,#modal-close-users").unbind().click(function (t) {
                t.preventDefault();
                //[#modal-overlay]と[#modal-close]をフェードアウトする
                $("#modal-content-users,#modal-overlay").fadeOut("slow", function () {
                    //フェードアウト後、[#modal-overlay]をHTML(DOM)上から削除
                    $("#modal-overlay").remove();
                });
                $('#container').css({'overflow': 'visible'});
            });
        });
        $('#users-list li').on('click', function(){
            if($(this).hasClass('selected')){
                $(this).removeClass('selected');
            }else{
                $(this).addClass('selected');
            }
        });
        $('#done-users').on('click', function(t){
            t.preventDefault();
            var ids = [];
            var names = [];
            $('#users-list .selected').each(function(){
                ids.push($(this).data('id'));
                names.push($(this).data('name'));
            });
            var id = ids.join();
            var name = names.join();
            $('input[name=parties]').val(id);
            $('input[name=parties_name]').val(name);
            $('p.parties').text(name);
            $('#modal-close-users').trigger('click');
        });
    });
</script>
@endsection