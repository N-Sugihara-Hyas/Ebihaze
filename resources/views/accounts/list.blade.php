@extends('layouts.accountsheader')

@section('content')
<div class="container hidden">
    <ul class="accounts-list accounts-nav">
        <li class="accounts-nav__item accounts-nav__item--active tab" data-id="1">口座１</li>
        <li class="accounts-nav__item accounts-nav__item--inactive tab" data-id="2">口座２</li>
        <li class="accounts-nav__item accounts-nav__item--inactive tab" data-id="3">口座３</li>
    </ul>
    <section class="accounts-total" data-id="account1">
        <p class="accounts-item-amount">資産</p>
        <p class="accounts-item-price">¥{{number_format($accounts[0]->total)}}</p>
    </section>
    <section class="accounts-total" data-id="account2">
        <p class="accounts-item-amount">資産</p>
        <p class="accounts-item-price">¥{{number_format($accounts[1]->total)}}</p>
    </section>
    <section class="accounts-total" data-id="account3">
        <p class="accounts-item-amount">資産</p>
        <p class="accounts-item-price">¥{{number_format($accounts[2]->total)}}</p>
    </section>
    <h2 class="accounts-history">残高履歴</h2>
    <ul class="accounts-list c-list" data-id="account1">
        @foreach($accounts[0] as $account)
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
    <ul class="accounts-list c-list" data-id="account2">
        @foreach($accounts[1] as $account)
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
    <ul class="accounts-list c-list" data-id="account3">
        @foreach($accounts[2] as $account)
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
@section('scripts')
<script>
    $(function(){
        $('[data-id^=account]').hide();
        $('[data-id=account1]').show();
        $('.tab').on('click', function(){
            var id = $(this).data('id');
            $('[data-id^=account]').hide();
            $('[data-id=account'+id+']').show();
            $('.tab').removeClass('accounts-nav__item--active').addClass('accounts-nav__item--inactive');
            $(this).removeClass('accounts-nav__item--inactive').addClass('accounts-nav__item--active');

            return false;
        });
        // container to visible
        $('.container.hidden').removeClass('hidden');
    });
</script>
@endsection