@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <ul class="accounts-list accounts-nav">
        <li class="accounts-nav__item accounts-nav__item--active">口座１の名前</li>
        <li class="accounts-nav__item accounts-nav__item--inactive">口座２の名前</li>
        <li class="accounts-nav__item accounts-nav__item--inactive">口座３の名前</li>
    </ul>
    <section class="accounts-list accounts-nav">
        <span class="accounts-item-amount">資産</span>
        <small class="accounts-item-price">¥12,987,000</small>
    </section>
    <h2>残高履歴</h2>
    <ul class="accounts-list c-list">
        @foreach([0,1,2,3,4,5] as $list)
        <li class="accounts-list__item c-list__item">
            <div class="accounts-item-container">
                <section class="accounts-item-date">
                    <p>2017/05/01</p>
                </section>
                <section class="accounts-item-status">
                    <p>修繕費入金</p>
                </section>
                <section class="accounts-item-amount">
                    <p>¥12,987,000</p>
                </section>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection
