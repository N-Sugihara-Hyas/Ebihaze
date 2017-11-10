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
                <dt class="users-add_list-title__user-tel">携帯電話番号</dt>
                <dd class="users-add_list-form__user-tel">
                    {{$user->tel}}
                    <input type="hidden" name="user[id]" value="{{$user->id}}">
                    <input type="hidden" name="user[type]" value="officer">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-nickname">ニックネーム *</dt>
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
                <dt class="users-add_list-title__room-room_number">部屋番号 *</dt>
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
                    <input type="text" value="{{old('room.floor_plan')}}" name="room[floor_plan]">
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
                <dt class="users-add_list-title__apartment-name">マンション名</dt>
                <dd class="users-add_list-form__apartment-name">
                    <input type="text" value="{{old('apartment.name')}}" name="apartment[name]">
                    {{--<button>検索</button>--}}
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-address">マンション住所入力</dt>
                <dd class="users-add_list-form__apartment-address">
                    <input type="text" value="{{old('apartment.address')}}" name="apartment[address]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-notification">他マンション管理人からのコンタクト</dt>
                <dd class="users-add_list-form__user-notification">
                    <input type="radio" name="user[notification]" value="1" {{(old('user.notification')==1||empty(old('user.notification'))) ? 'checked' : ''}}>はい
                    <input type="radio" name="user[notification]" value="0" {{(old('user.notification')==0) ? 'checked' : ''}}>いいえ
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-reside">管理形態</dt>
                <dd class="users-add_list-form__user-reside">
                    <select name="apartment[control]" id="">
                        @foreach($apartment::$control as $ctrl)
                       <option value="{{$ctrl}}" {{(old('apartment.control')==$ctrl) ? 'selected' : ''}}>{{$ctrl}}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-construction">構造</dt>
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
                    <input type="text" value="{{old('user.pet')}}" name="user[pet]" id="">
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
                <dd class="users-add_list-form__apartment-insurance">
                    <input type="checkbox" value="{{old('apartment.insurance')}}" name="apartment[insurance][]">
                    <input type="checkbox" value="{{old('apartment.insurance')}}" name="apartment[insurance][]">
                    <input type="checkbox" value="{{old('apartment.insurance')}}" name="apartment[insurance][]">
                    <input type="checkbox" value="{{old('apartment.insurance')}}" name="apartment[insurance][]">
                    <input type="checkbox" value="{{old('apartment.insurance')}}" name="apartment[insurance][]">
                    <input type="checkbox" value="{{old('apartment.insurance')}}" name="apartment[insurance][]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-completion_date">竣工年月</dt>
                <dd class="users-add_list-form__apartment-completion_date">
                    <input type="text" value="{{old('apartment.completion_date')}}" name="apartment[completion_date]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-total_units">総戸数</dt>
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
