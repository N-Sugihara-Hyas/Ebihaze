@extends('layouts.accountscomplete')

@section('content')
<div class="container">
    <ul class="accounts-list accounts-nav">
        <li class="accounts-nav__item {{($account->sub_id==1) ? 'accounts-nav__item--active' : 'accounts-nav__item--inactive'}}">口座１</li>
        <li class="accounts-nav__item {{($account->sub_id==2) ? 'accounts-nav__item--active' : 'accounts-nav__item--inactive'}}">口座２</li>
        <li class="accounts-nav__item {{($account->sub_id==3) ? 'accounts-nav__item--active' : 'accounts-nav__item--inactive'}}">口座３</li>
    </ul>
    <section class="accounts-total">
        <p class="accounts-item-amount">資産</p>
        <p class="accounts-item-price">¥{{$account->total}}</p>
    </section>
    <h2>コメント表示</h2>
    <form action="{{route('post.accounts-edit')}}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="account_id" value="{{$account->id}}">
    <ul class="accounts-list c-list">
        <li class="accounts-list__item c-list__item">
            <div class="accounts-item-container">
                <section class="accounts-item__title">
                    <p>金額</p>
                </section>
                <section class="accounts-item__category">
                    <input type="number" class="accounts-item__input" name="account_amount" value="{{$account->amount}}" placeholder="1000000">円
                </section>
            </div>
        </li>
        <li class="accounts-list__item c-list__item">
            <div class="accounts-item-container">
                <section class="accounts-item__title">
                    <p>記帳する日付</p>
                </section>
                <section class="accounts-item__date">
                    <input type="text" id="datepicker" name="account_schedule" value="{{date('Y/m/d', strtotime($account->schedule))}}">
                    {{--<select name="account_schedule" id="" class="accounts-item__select">--}}
                        {{--@foreach(range(-365, 365) as $day)--}}
                            {{--@if($day==0)--}}
                            {{--<option value="{{date('Y-m-d', strtotime($day."day"))}}" selected>{{date('Y-m-d', strtotime($day."day"))}}</option>--}}
                            {{--@else--}}
                            {{--<option value="{{date('Y-m-d', strtotime($day."day"))}}">{{date('Y-m-d', strtotime($day."day"))}}</option>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                </section>
            </div>
        </li>
        <li class="accounts-list__item c-list__item">
            <div class="accounts-item-container">
                <section class="accounts-item__title">
                    <p>記帳する項目</p>
                </section>
                <section class="accounts-item__category">
                    <input type="text" class="accounts-item__input" name="account_category" placeholder="タップして入力して下さい" value="{{$account->category}}">
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
        $('#datepicker').datepicker();
    });
</script>
@endsection