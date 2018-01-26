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
                    <input type="hidden" name="user[type]" value="common">
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
                <dt class="users-add_list-title__apartment-facilities">ユーザー画像登録</dt>
                <dd class="users-add_list-form__apartment-facilities">
                    <button class="c-btn c-btn--large c-btn--blue action" data-method="file">画像登録</button>
                    <input type="file" name="user_icon">
                </dd>
            </dl>
            <div class="users-add_form__submit">
                <button class="c-btn c-btn--large c-btn--blue action" data-method="post">確認</button>
            </div>
        </div>
    </form>
</div>
@endsection
