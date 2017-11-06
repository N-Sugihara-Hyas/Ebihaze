@extends('layouts.globalheader')

@section('content')
<div class="container">
    <ul class="apartments-list c-list">
        @foreach($apartments as $apart)
        <a href="{{route('apartments-detail', $apart->id)}}">
            <li class="apartments-list__item c-list__item">
                <div class="apartments-item-container">
                    <section class="apartments-item-main">
                        <p class="apartments-item-title">
                            {{$apart->name}}<br>
                        </p>
                    </section>
                    <section class="apartments-item-icon">
                        <figure>
                            <img class="c-circle" width="41px" height="41px" src="{{asset("img/resources/apartment/$apart->id/icon")}}" alt="">
                        </figure>
                    </section>
                </div>
            </li>
        </a>
        @endforeach
    </ul>
</div>
@endsection
