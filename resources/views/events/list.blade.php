@extends('layouts.globalmenu')

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
    <ul class="event-list c-list">
        @foreach($events as $event)
        <a href="{{route('events-detail', $event->id)}}">
            <li class="event-list__item c-list__item {{($event->status=='required') ? 'event-list__item--required' : ''}}{{($event->status=='done') ? 'event-list__item--done' : ''}}">
                <div class="event-item-container">
                    <section class="event-item-thumb">
                        <figure>
                            <img width="60px" heihgt="60px" src="{{asset('img/resources/event/'.$event->id.'/thumb')}}" alt="">
                        </figure>
                    </section>
                    <section class="event-item-main">
                        <div class="event-item-main__header">
                            <p class="event-item-main__title">
                                @if($event->status=='required')
                                <span style="color:red;">(要評価)</span>
                                @endif
                                {{$event->title}}
                                @if($event->status=='done')
                                <span>(完了)</span>
                                @endif
                                <br><small>{{$event->parties}}</small>
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
                                {{$event->updated_at}}
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
