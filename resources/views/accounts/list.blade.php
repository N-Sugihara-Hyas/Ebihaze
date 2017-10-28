@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <ul class="accounts-list accounts-nav">
        <li class="accounts-nav__item accounts-nav__item--active">口座１の名前</li>
        <li class="accounts-nav__item accounts-nav__item--inactive">口座２の名前</li>
        <li class="accounts-nav__item accounts-nav__item--inactive">口座３の名前</li>
    </ul>
    <section class="accounts-total">
        <p class="accounts-item-amount">資産</p>
        <p class="accounts-item-price">¥{{number_format($total)}}</p>
    </section>
    <h2 class="accounts-history">残高履歴</h2>
    <ul class="accounts-list c-list">
        @foreach($accounts as $account)
        <a href="{{route('accounts-edit', $account->id)}}">
            <li class="accounts-list__item c-list__item">
                <div class="accounts-item-container">
                    <section class="accounts-item-date">
                        <p>{{date('Y/m/d', strtotime($account->schedule))}}</p>
                    </section>
                    <section class="accounts-item-status">
                        <p>{{$account->category}}</p>
                    </section>
                    <section class="accounts-item-amount">
                        <p>¥{{number_format($account->amount)}}</p>
                    </section>
                </div>
            </li>
        </a>
        @endforeach
    </ul>
</div>
@endsection
