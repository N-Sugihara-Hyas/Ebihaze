@extends('layouts.globalheader')

@section('content')
<div class="container">
    <ul class="apartments-list c-list">
        @foreach($apartments as $apart)
        <a href="{{route('apartments-edit', $apart->id)}}">
            <li class="apartments-list__item c-list__item">
                <div class="apartments-item-container">
                    <section class="apartments-item-main">
                        <p class="apartments-item-title">
                            {{$apart->name}}<br>
                        </p>
                    </section>
                    <section class="apartments-item-icon">
                        <figure>
                            <img width="100%" src="{{asset('img/icon.png')}}" alt="">
                        </figure>
                    </section>
                </div>
            </li>
        </a>
        @endforeach
    </ul>
</div>
@endsection
