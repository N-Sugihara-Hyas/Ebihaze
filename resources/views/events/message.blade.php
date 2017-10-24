@extends('layouts.comment')

@section('content')
<div class="container">
    {{ csrf_field() }}
    <input type="hidden" name="_id" value="{{$event->id}}">
    <input type="hidden" name="comment_commentable_type" value="App\Event">
    <ul class="event-message c-list">
        @foreach($event->comments as $comment)
        @if($comment->user_id!=1)
        <li class="event-message__item event-message__item--you">
            <div class="event-message-container">
                <section class="event-message__body--you c-balloon--you">
                    <span>{{$comment->body}}</span>
                    <div class="c-balloon--container">
                        <div class="c-balloon__parts--you">&nbsp;</div>
                    </div>
                </section>
                <section class="event-message__thumb">
                    <figure>
                        <img src="" alt="">
                    </figure>
                </section>
            </div>
        </li>
        @else
        <li class="event-message__item event-message__item--me">
            <section class="event-message__body--me c-balloon--me">
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
