@extends('layouts.comment')

@section('content')
<div class="container">
    {{ csrf_field() }}
    <input type="hidden" name="_id" value="{{$event->id}}">
    <input type="hidden" name="comment_commentable_type" value="App\Event">
    <ul class="event-message c-list">
        @foreach($event->comments as $comment)
        @if($comment->user_id!=Auth::id())
        <li class="event-message__item event-message__item--you">
            <div class="event-message-container">
                <section class="event-message__body--you c-balloon--you">
                    @if($comment->is_image==1)
                        <figure>
                            <img src="{{asset('img/resources/comment/'.$comment->id.'/image')}}" alt="">
                        </figure>
                    @endif
                    <span>{{$comment->body}}</span>
                    <div class="c-balloon--container">
                        <div class="c-balloon__parts--you">&nbsp;</div>
                    </div>
                </section>
                <section class="event-message__thumb">
                    <figure>
                        <img class="c-circle" src="{{asset('img/resources/user/'.$comment->user_id.'/icon')}}" alt="">
                    </figure>
                </section>
            </div>
        </li>
        @else
        <li class="event-message__item event-message__item--me">
            <section class="event-message__body--me c-balloon--me">
                @if($comment->is_image==1)
                    <figure>
                        <img src="{{asset('img/resources/comment/'.$comment->id.'/image')}}" alt="">
                    </figure>
                @endif
                <span>{{$comment->body}}</span>
                <div class="c-balloon--container">
                    <div class="c-balloon__parts--me">&nbsp;</div>
                </div>
            </section>
        </li>
        @endif
        @endforeach
    </ul>
</div>
@endsection
