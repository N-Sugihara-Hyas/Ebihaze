@extends('layouts.accountscomplete')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <ul class="accounts-list accounts-nav">
        <li class="accounts-nav__item {{($account->sub_id==1) ? 'accounts-nav__item--active' : 'accounts-nav__item--inactive'}}">修繕積立金</li>
        <li class="accounts-nav__item {{($account->sub_id==2) ? 'accounts-nav__item--active' : 'accounts-nav__item--inactive'}}">管理費</li>
        <li class="accounts-nav__item {{($account->sub_id==3) ? 'accounts-nav__item--active' : 'accounts-nav__item--inactive'}}">その他</li>
    </ul>
    <section class="accounts-total">
        <p class="accounts-item-amount">取引金額</p>
        <p class="accounts-item-price">¥{{number_format($account->total)}}</p>
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
                    <input type="number" class="accounts-item__input" name="account_amount" value="{{$account->amount}}" placeholder="0">円
                </section>
            </div>
        </li>
        <li class="accounts-list__item c-list__item">
            <div class="accounts-item-container">
                <section class="accounts-item__title">
                    <p>日付</p>
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
                    <p>取引内容</p>
                </section>
                <section class="accounts-item__category">
                    <select name="account_category" class="accounts-item__input" id="" style="background:transparent;">
                        @foreach(["積立（まとめて入力可能）","大規模修繕実施","その他修繕実施"] as $category)
                            <option value="{{$category}}" {{(old('account_category')==$category) ? 'selected' : ''}}>
                                {{$category}}
                            </option>
                        @endforeach
                    </select>
                    {{--<input type="text" class="accounts-item__input" name="account_category" placeholder="タップして入力して下さい" value="{{$account->category}}">--}}
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