@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <ul class="event-list c-list">
        @foreach($events as $event)
        <a href="{{route('events-detail', $event->id)}}">
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
                                {{$event->title}}<br>
                                <small>{{$event->parties}}/{{$event->parties}}</small>
                            </p>
                            <figure class="event-item-main__icon">
                                <img src="{{asset('img/icon.png')}}" alt="">
                            </figure>
                        </div>
                        <div class="event-item-main__detail">
                            <p>
                                {{date('Y',strtotime($event->schedule))}}年
                                {{date('m',strtotime($event->schedule))}}月
                                {{date('d',strtotime($event->schedule))}}日
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
        </a>
        @endforeach
    </ul>
</div>
@endsection
