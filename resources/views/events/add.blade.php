@extends('layouts.globalheader')

@section('content')
<div class="container" id="event-form">
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
                <input type="text" name="title" value="{{old('title')}}">
            </dd>
        </dl>
        <dl class="event-form">
            <dt class="event-form__title">
                施工日時
            </dt>
            <dd class="event-form__input">
                日時：<input type="text" name="schedule[Ymd]" id="datepicker" value="{{old('schedule.Ymd')}}">
                時間：<select name="schedule[Hi]" id="datepicker">
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
                業者
            </dt>
            <dd class="event-form__input">
                <input type="text" name="suppliers" value="{{old('suppliers')}}">
            </dd>
        </dl>
        <dl class="event-form">
            <dt class="event-form__title">
                内容
            </dt>
            <dd class="event-form__input">
                <input type="text" name="content" value="{{old('content')}}">
            </dd>
        </dl>
        <dl class="event-form">
            <dt class="event-form__title">
                関係者
            </dt>
            <dd class="event-form__input">
                <input type="text" name="parties" value="{{old('parties')}}">
            </dd>
        </dl>

        <section class="c-btn-area">
            <div class="c-btn-area__large">
                <button class="c-btn c-btn--large c-btn--blue action" data-method="file">画像登録</button>
                <input type="file" name="event_thumb">
            </div>
            <div class="c-btn-area__small">
                <button class="c-btn c-btn--small c-btn--white action" data-method="cancel">キャンセル</button>
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
        $('#datepicker').datepicker();
    });
</script>
@endsection