@extends('layouts.globalheader')

@section('content')
<div class="container">
    <ul class="apartments-list c-list">
        <form action="{{route('post.apartments-switch')}}" method="post">{{csrf_field()}}</form>
        @foreach($apartments as $apart)
        <a href="#" class="action" data-method="switch" data-id="{{$apart->id}}">
            <li class="apartments-list__item c-list__item">
                <div class="apartments-item-container">
                    <section class="apartments-item-main">
                        <p class="apartments-item-title">
                            {{$apart->name}}<br>
                        </p>
                    </section>
                    <section class="apartments-item-icon">
                        <figure>
                            <img class="c-circle" width="40px" height="40px" src="{{asset('img/resources/apartment/'.$apart->id.'/icon')}}" alt="">
                        </figure>
                    </section>
                </div>
            </li>
        </a>
        @endforeach
    </ul>
</div>
@endsection
