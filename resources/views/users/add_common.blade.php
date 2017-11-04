@extends('layouts.usersheader')

@section('content')
<div class="container">
    <div class="users-add_title">
        <p>
            認証されました<br>
            アプリ利用に必要な情報の入力をお願いいたします
        </p>
    </div>
    <form action="{{route('post.users-add')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="users-add_form__container">
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-tel">携帯電話番号</dt>
                <dd class="users-add_list-form__user-tel">
                    {{$user->tel}}
                    <input type="hidden" name="user[id]" value="{{$user->id}}">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-nickname">ニックネーム *</dt>
                <dd class="users-add_list-form__user-nickname">
                    <input type="text" class="user-add_input" name="user[nickname]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__room-room_number">部屋番号 *</dt>
                <dd class="users-add_list-form__room-room_number">
                    <input type="text" name="room[room_number]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__room-floor">所在階</dt>
                <dd class="users-add_list-form__room-floor">
                    <input type="text" name="room[floor]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-gender">性別</dt>
                <dd class="users-add_list-form__user-gender">
                    <select name="user[gender]" id="">
                        <option value="1">男性</option>
                        <option value="2">女性</option>
                        <option value="9">不明</option>
                    </select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-birthday">生まれ年</dt>
                <dd class="users-add_list-form__user-birthday">
                    <input type="text" name="user[birthday]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-job">職業</dt>
                <dd class="users-add_list-form__user-job">
                    <select name="user[job]" id="">
                        @foreach($user::$job as $jb)
                        <option value="{{$jb}}">{{$jb}}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <div class="users-add_form__submit">
                <button class="c-btn c-btn--large c-btn--blue action" data-method="post">確認</button>
            </div>
        </div>
    </form>
</div>
@endsection
