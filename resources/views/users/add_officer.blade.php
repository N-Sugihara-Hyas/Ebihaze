@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <div class="users-add_title">
        <p>
            認証されました
            アプリ利用に必要な情報の入力をお願いいたします
        </p>
    </div>
    <form action="{{route('post.users-add')}}" method="post">
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
                <dt class="users-add_list-title__building-name">棟/建物名</dt>
                <dd class="users-add_list-form__building-name">
                    <input type="text" name="building[name]">
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
                <dt class="users-add_list-title__user-owned">所有形態</dt>
                <dd class="users-add_list-form__user-owned">
                    <input type="text" name="user[owned]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__room-floor_plan">間取り</dt>
                <dd class="users-add_list-form__room-floor_plan">
                    <input type="text" name="room[floor_plan]">
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
                        <option value="testJob">TEST JOB</option>
                        <option value="testJob">TEST JOB</option>
                        <option value="testJob">TEST JOB</option>
                        <option value="testJob">TEST JOB</option>
                    </select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-name">マンション名</dt>
                <dd class="users-add_list-form__apartment-name">
                    <button>検索</button>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-address">マンション住所入力</dt>
                <dd class="users-add_list-form__apartment-address">
                    <input type="text" name="apartment[address]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-notification">他マンション管理人からのコンタクト</dt>
                <dd class="users-add_list-form__user-notification">
                    <input type="radio" name="user[notification]" value="1">はい
                    <input type="radio" name="user[notification]" value="0">いいえ
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-reside">管理形態</dt>
                <dd class="users-add_list-form__user-reside">
                    <select name="user[reside]" id=""></select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-construction">構造</dt>
                <dd class="users-add_list-form__apartment-construction">
                    <select name="apartment[construction]" id=""></select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-pet">ペット</dt>
                <dd class="users-add_list-form__user-pet">
                    <select name="user[pet]" id=""></select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-facilities">付帯設備</dt>
                <dd class="users-add_list-form__apartment-facilities">
                    <input type="checkbox" name="apartment[facilities][]">
                    <input type="checkbox" name="apartment[facilities][]">
                    <input type="checkbox" name="apartment[facilities][]">
                    <input type="checkbox" name="apartment[facilities][]">
                    <input type="checkbox" name="apartment[facilities][]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">保険情報</dt>
                <dd class="users-add_list-form__apartment-insurance">
                    <input type="checkbox" name="apartment[insurance][]">
                    <input type="checkbox" name="apartment[insurance][]">
                    <input type="checkbox" name="apartment[insurance][]">
                    <input type="checkbox" name="apartment[insurance][]">
                    <input type="checkbox" name="apartment[insurance][]">
                    <input type="checkbox" name="apartment[insurance][]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-completion_date">竣工年月</dt>
                <dd class="users-add_list-form__apartment-completion_date">
                    <input type="text" name="apartment[completion_date]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-total_units">総戸数</dt>
                <dd class="users-add_list-form__apartment-total_units">
                    <input type="text" name="apartment[total_units]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-introduction">マンション紹介テキスト(1,000文字まで)</dt>
                <dd class="users-add_list-form__apartment-introduction">
                    <textarea name="apartment[introduction]" id="" cols="30" rows="10"></textarea>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-facilities">マンション画像登録</dt>
                <dd class="users-add_list-form__apartment-facilities">
                    <button>画像登録</button>
                </dd>
            </dl>
            <div class="users-add_form__submit">
                <button class="c-btn c-btn--large c-btn--blue action" data-method="post">確認</button>
            </div>
        </div>
    </form>
</div>
@endsection
