@extends('layouts.accountscomplete')

@section('content')
<div class="container">
    <ul class="accounts-list accounts-nav">
        <li class="accounts-nav__item accounts-nav__item--active">口座１の名前</li>
        <li class="accounts-nav__item accounts-nav__item--inactive">口座２の名前</li>
        <li class="accounts-nav__item accounts-nav__item--inactive">口座３の名前</li>
    </ul>
    <section class="accounts-total">
        <p class="accounts-item-amount">資産</p>
        <p class="accounts-item-price">¥12,987,000</p>
    </section>
    <h2>コメント表示</h2>
    <form action="{{route('post.accounts-edit')}}" method="post">
    <ul class="accounts-list c-list">
        <li class="accounts-list__item c-list__item">
            <div class="accounts-item-container">
                <section class="accounts-item__title">
                    <p>記帳する日付</p>
                </section>
                <section class="accounts-item__date">
                    <select name="account_schedule" id="" class="accounts-item__select">
                        @foreach(range(-31, 31) as $day)
                            @if($day==0)
                            <option value="{{date('Y-m-d', strtotime($day."day"))}}" selected>{{date('Y-m-d', strtotime($day."day"))}}</option>
                            @else
                            <option value="{{date('Y-m-d', strtotime($day."day"))}}">{{date('Y-m-d', strtotime($day."day"))}}</option>
                            @endif
                        @endforeach
                    </select>
                </section>
            </div>
        </li>
        <li class="accounts-list__item c-list__item">
            <div class="accounts-item-container">
                <section class="accounts-item__title">
                    <p>記帳する項目</p>
                </section>
                <section class="accounts-item__category">
                    <input type="text" class="accounts-item__input" name="account_category" placeholder="タップして入力して下さい">
                </section>
            </div>
        </li>
    </ul>
    </form>
</div>
@endsection
