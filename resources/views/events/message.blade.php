@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <ul class="event-message c-list">
        @foreach([0,1,2,3,4,5] as $list)
        <li class="event-message__item event-message__item--you">
            <div class="event-message-container">
                <section class="event-message__body--you c-balloon--you">
                    <span>You!!You!!You!!You!!You!!You!!You!!You!!You!!You!!You!!You!!You!!You!!You!!You!!You!!You!!You!!You!!</span>
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
        <li class="event-message__item event-message__item--me">
            <section class="event-message__body--me c-balloon--me">
                <span>Me!!Me!!Me!!Me!!Me!!Me!!Me!!Me!!Me!!Me!!Me!!Me!!Me!!Me!!Me!!Me!!Me!!</span>
                <div class="c-balloon--container">
                    <div class="c-balloon__parts--me">&nbsp;</div>
                </div>
            </section>
        </li>
        @endforeach
    </ul>
</div>
@endsection
