@extends('layouts.globalcomment')

@section('content')
<div class="container">
    <div class="event-detail">
        <section class="event-detail__header">
            <h1 class="event-detail__title">{{$event->title}}</h1>
            <p class="event-detail__notes">{{date('Y', strtotime($event->updated_at))}}年{{date('m', strtotime($event->updated_at))}}月{{date('d', strtotime($event->updated_at))}}日 {{date('H:i', strtotime($event->updated_at))}}更新</p>
        </section>
        <section class="event-detail__body">
            <p class="event-detail__schedule">{{date('m', strtotime($event->schedule))}}月{{date('d', strtotime($event->schedule))}}日 {{date('H:i', strtotime($event->schedule))}}〜 {{date('m', strtotime($event->schedule))}}月{{date('d', strtotime($event->schedule))}}日 {{date('H:i', strtotime($event->schedule))}}</p>
            <p class="event-detail__suppliers">{{$event->suppliers}}</p>
            <p class="event-detail__parties">{{$event->parties}}</p>
            <p class="event-detail__message">
                {{$event->document}}
            </p>
            <figure class="event-detail__picture">
                <img width="100%" src="{{asset('img/detail_pic.png')}}" alt="案件画像">
            </figure>
        </section>
        <section class="event-detail__footer">
            <div class="c-btn-area__large">
                <a href="{{route('events-review', $event->id)}}">
                    <button class="c-btn c-btn--small c-btn--blue">完了</button>
                </a>
            </div>
        </section>
    </div>
</div>
@endsection
