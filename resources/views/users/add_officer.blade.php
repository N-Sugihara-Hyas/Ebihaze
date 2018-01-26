@extends('layouts.usersheader')

@section('content')
<div class="container">
    <div class="users-add_title">
        <p>
            認証されました<br>
            アプリ利用に必要な情報の入力をお願いいたします
        </p>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('post.users-add')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="users-add_form__container">
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-tel">携帯電話番号 <span class="c-required">*</span></dt>
                <dd class="users-add_list-form__user-tel">
                    {{$user->tel}}
                    <input type="hidden" name="user[id]" value="{{$user->id}}">
                    <input type="hidden" name="user[type]" value="officer">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-password">パスワード <span class="c-required">*</span></dt>
                <dd class="users-add_list-form__user-password">
                    <input type="password" class="user-add_input" value="" name="user[password]">
                </dd>
                <dt class="users-add_list-title__user-password_confirmation">パスワード（確認用） <span class="c-required">*</span></dt>
                <dd class="users-add_list-form__user-password_confirmation">
                    <input type="password" class="user-add_input" value="" name="user[password_confirmation]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-nickname">ニックネーム <span class="c-required">*</span></dt>
                <dd class="users-add_list-form__user-nickname">
                    <input type="text" class="user-add_input" value="{{old('user.nickname')}}" name="user[nickname]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__building-name">棟/建物名</dt>
                <dd class="users-add_list-form__building-name">
                    <input type="text" value="{{old('building.name')}}" name="building[name]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__room-room_number">部屋番号 <span class="c-required">*</span></dt>
                <dd class="users-add_list-form__room-room_number">
                    <input type="text" value="{{old('room.room_number')}}" name="room[room_number]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__room-floor">所在階</dt>
                <dd class="users-add_list-form__room-floor">
                    <input type="text" value="{{old('room.floor')}}" name="room[floor]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-owned">所有形態</dt>
                <dd class="users-add_list-form__user-owned">
                    <select name="user[owned]" id="">
                        @foreach($user::$owned as $key => $val)
                        <option value="{{$key}}" {{(old('user.owned')==$key) ? 'selected' : ''}}>{{$val}}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__room-floor_plan">間取り</dt>
                <dd class="users-add_list-form__room-floor_plan">
                    <select name="room[floor_plan--num]" id="">
                        @foreach(range(1,9) as $num)
                        <option value="{{$num}}">{{$num}}</option>
                        @endforeach
                    </select>
                    <select name="room[floor_plan--type]" id="">
                        @foreach(['R', 'K', 'DK', 'LDK'] as $type)
                        <option value="{{$type}}">{{$type}}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-gender">性別</dt>
                <dd class="users-add_list-form__user-gender">
                    <select name="user[gender]" id="">
                        <option value="1" {{(old('user.gender')==1) ? 'selected' : ''}}>男性</option>
                        <option value="2" {{(old('user.gender')==2) ? 'selected' : ''}}>女性</option>
                        <option value="9" {{(old('user.gender')==9) ? 'selected' : ''}}>不明</option>
                    </select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-birthday">生まれ年</dt>
                <dd class="users-add_list-form__user-birthday">
                    <select name="user[birthday]" id="">
                        @foreach(range(date('Y', strtotime('-100 year')), date('Y')) as $year)
                            <option value="{{$year}}" {{($year==date('Y', strtotime('-50Year'))) ? 'selected' : ''}}>{{$year}}</option>
                        @endforeach
                    </select>年
                    {{--<input type="text" value="{{old('user.birthday')}}" name="user[birthday]">年--}}
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-job">職業</dt>
                <dd class="users-add_list-form__user-job">
                    <select name="user[job]" id="">
                        @foreach($user::$job as $jb)
                        <option value="{{$jb}}" {{(old('user.job')==$jb) ? 'selected' : ''}}>{{$jb}}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-name">マンション名 <span class="c-required">*</span></dt>
                <dd class="users-add_list-form__apartment-name">
                    <input id="text" type="text" name="apartment[name]" value="{{old('apartment.name')}}" autocomplete="off" size="10" style="display: block">
                    <!-- 補完候補を表示するエリア -->
                    <div id="suggest" style="display:none;"></div>                    {{--<button>検索</button>--}}
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-address">マンション住所入力 <span class="c-required">*</span></dt>
                <dd class="users-add_list-form__apartment-address">
                    <input type="text" value="{{old('apartment.address')}}" name="apartment[address]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-notification">他マンション管理人からのコンタクト <span class="c-required">*</span></dt>
                <dd class="users-add_list-form__user-notification">
                    <input type="radio" name="user[notification]" value="1" {{(old('user.notification')==1||empty(old('user.notification'))) ? 'checked' : ''}}>はい
                    <input type="radio" name="user[notification]" value="0" {{(old('user.notification')==0) ? 'checked' : ''}}>いいえ
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-reside">管理形態 <span class="c-required">*</span></dt>
                <dd class="users-add_list-form__user-reside">
                    <select name="apartment[control]" id="">
                        @foreach($apartment::$control as $ctrl)
                       <option value="{{$ctrl}}" {{(old('apartment.control')==$ctrl) ? 'selected' : ''}}>{{$ctrl}}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-construction">構造 <span class="c-required">*</span></dt>
                <dd class="users-add_list-form__apartment-construction">
                    <select name="apartment[construction]" id="">
                        @foreach($apartment::$construction as $const)
                        <option value="{{$const}}" {{(old('apartment.construction')==$const) ? 'selected' : ''}}>{{$const}}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-pet">ペット</dt>
                <dd class="users-add_list-form__user-pet">
                    <select name="user[pet]" id="">
                        @foreach($user::$pet as $p)
                        <option value="{{$p}}" {{(old('user.pet')==$p) ? 'selected' : ''}}>{{$p}}</option>
                        @endforeach
                    </select>
                    {{--<input type="text" value="{{old('user.pet')}}" name="user[pet]" id="">--}}
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-facilities">付帯設備</dt>
                <dd class="users-add_list-form__apartment-facilities">
                    @foreach($apartment::$facilities as $num => $fclt)
                    <label for="{{$num+1}}">
                        @if(!is_null(old('apartment.facilities')))
                            <input id="{{$num+1}}" type="checkbox" name="apartment[facilities][]" value="{{$fclt}}" {{(in_array($fclt, old('apartment.facilities'))) ? 'checked' : ''}}>
                        @else
                            <input id="{{$num+1}}" type="checkbox" name="apartment[facilities][]" value="{{$fclt}}">
                        @endif
                        {{$fclt}}
                    </label>
                    @endforeach
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">保険情報</dt>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">■保険１</dt>
                <dd class="users-add_list-form__apartment-insurance">
                    <label for="">保険名<input type="text" value="{{old('insurance.1.name')}}" name="insurance[1][name]"></label>
                    <label for="">期日<input type="text" id="datepicker1" value="{{old('insurance.1.expired')}}" name="insurance[1][expired]"></label>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">■保険２</dt>
                <dd class="users-add_list-form__apartment-insurance">
                    <label for="">保険名<input type="text" value="{{old('insurance.2.name')}}" name="insurance[2][name]"></label>
                    <label for="">期日<input type="text" id="datepicker2" value="{{old('insurance.2.expired')}}" name="insurance[2][expired]"></label>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">■保険３</dt>
                <dd class="users-add_list-form__apartment-insurance">
                    <label for="">保険名<input type="text" value="{{old('insurance.3.name')}}" name="insurance[3][name]"></label>
                    <label for="">期日<input type="text" id="datepicker3" value="{{old('insurance.3.expired')}}" name="insurance[3][expired]"></label>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">■保険４</dt>
                <dd class="users-add_list-form__apartment-insurance">
                    <label for="">保険名<input type="text" value="{{old('insurance.4.name')}}" name="insurance[4][name]"></label>
                    <label for="">期日<input type="text" id="datepicker4" value="{{old('insurance.4.expired')}}" name="insurance[4][expired]"></label>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">■保険５</dt>
                <dd class="users-add_list-form__apartment-insurance">
                    <label for="">保険名<input type="text" value="{{old('insurance.5.name')}}" name="insurance[5][name]"></label>
                    <label for="">期日<input type="text" id="datepicker5" value="{{old('insurance.5.expired')}}" name="insurance[5][expired]"></label>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-completion_date">竣工年月 <span class="c-required">*</span></dt>
                <dd class="users-add_list-form__apartment-completion_date">
                    <select name="apartment[completion_date--year]" id="">
                    @foreach(range(date('Y', strtotime('-100 year')), date('Y')) as $year)
                        <option value="{{$year}}年" {{($year==date('Y')) ? 'selected' : ''}}>{{$year}}</option>
                    @endforeach
                    </select>年
                    <select name="apartment[completion_date--month]" id="">
                        @foreach(range(1, 12) as $month)
                            <option value="{{$month}}月" {{($month==date('m')) ? 'selected' : ''}}>{{$month}}</option>
                        @endforeach
                    </select>月
                    {{--<input type="text" value="{{old('apartment.completion_date')}}" name="apartment[completion_date]">--}}
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-total_units">総戸数 <span class="c-required">*</span></dt>
                <dd class="users-add_list-form__apartment-total_units">
                    <input type="text" value="{{old('apartment.total_units')}}" name="apartment[total_units]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-introduction">マンション紹介テキスト(1,000文字まで)</dt>
                <dd class="users-add_list-form__apartment-introduction">
                    <textarea name="apartment[introduction]" id="" cols="30" rows="10">{{old('apartment.introduction')}}</textarea>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-facilities">ユーザー画像登録</dt>
                <dd class="users-add_list-form__apartment-facilities">
                    <button class="c-btn c-btn--large c-btn--blue action" data-method="file">画像登録</button>
                    <input type="file" name="user_icon">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-facilities">マンション画像登録</dt>
                <dd class="users-add_list-form__apartment-facilities">
                    <button class="c-btn c-btn--large c-btn--blue action" data-method="file">画像登録</button>
                    <input type="file" name="apartment_icon">
                </dd>
            </dl>
            <div class="users-add_form__submit">
                <button class="c-btn c-btn--large c-btn--blue action" data-method="post">確認</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script>
    $(function() {
        $("#datepicker1").datepicker();
        $("#datepicker2").datepicker();
        $("#datepicker3").datepicker();
        $("#datepicker4").datepicker();
        $("#datepicker5").datepicker();
    });
</script>
<script src="{{asset('js/suggest.js')}}"></script>
<script>
$(function(){
    function startSuggest() {
        var list = [{!! $apartment->names !!}];
        new Suggest.Local(
                "text",    // 入力のエレメントID
                "suggest", // 補完候補を表示するエリアのID
                list,      // 補完候補の検索対象となる配列
                {dispMax: 10, interval: 1000}
        ); // オプション
    }

    window.addEventListener ?
            window.addEventListener('load', startSuggest, false) :
            window.attachEvent('onload', startSuggest);
});
</script>
@endsection
