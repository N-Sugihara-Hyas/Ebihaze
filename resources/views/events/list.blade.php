@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <ul class="event-list c-list">
        @foreach([0,1,2,3,4,5] as $list)
        <li class="event-list__item c-list__item">
            <div class="event-item-container">
                <section class="event-item-thumb">
                    <figure>
                        <img src="{{asset('img/thumb.png')}}" alt="">
                    </figure>
                </section>
                <section class="event-item-main">
                    <div class="event-item-main__header">
                        <p class="event-item-main__title">
                            エントランス掃除<br>
                            <small>&nbsp;業者名/業者名</small>
                        </p>
                        <figure class="event-item-main__icon">
                            <img src="{{asset('img/icon.png')}}" alt="">
                        </figure>
                    </div>
                    <div class="event-item-main__detail">
                        <p>
                            5月15日 10:00〜
                        </p>
                    </div>
                    <div class="event-item-main__footer">
                        <p>
                            2017年4月10日 12:35更新
                        </p>
                    </div>
                </section>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection
