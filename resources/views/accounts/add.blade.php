@extends('layouts.accountscomplete')

@section('content')
<div class="container">
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
    <h2>コメント表示</h2>
    <form action="{{route('post.accounts-add')}}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="account_sub_id" value="1" id="accountSubId">
    <ul class="accounts-list c-list">
        <li class="accounts-list__item c-list__item">
            <div class="accounts-item-container">
                <section class="accounts-item__title">
                    <p>金額</p>
                </section>
                <section class="accounts-item__category">
                    <input type="number" class="accounts-item__input" name="account_amount" value="" placeholder="0">円
                </section>
            </div>
        </li>
        <li class="accounts-list__item c-list__item">
            <div class="accounts-item-container">
                <section class="accounts-item__title">
                    <p>記帳する日付</p>
                </section>
                <section class="accounts-item__date">
                    <input type="text" id="datepicker" name="account_schedule" value="">
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
            // subId追加
            $('#accountSubId').val(id);
            return false;
        });
    });
</script>
<script>
    $(function(){
        $('#datepicker').datepicker();
    });
</script>
@endsection