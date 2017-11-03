@extends('layouts.globalheader')

@section('content')
<div class="container">
    <ul class="apartments-list c-list">
        @foreach($apartments as $num => $apart)
        <li class="apartments-list__item c-list__item">
            <div class="apartments-item-container">
                <section class="apartments-item-num">
                    <p class="apartments-item-batch">{{++$num}}</p>
                </section>
                <section class="apartments-item-main">
                    <p class="apartments-item-title">
                        {{$apart->name}}<br>
                        <span class="apartments-item-rank__fav">
                            ★
                        </span>
                            <span class="apartments-item-rank__score">
                            4.3
                        </span>
                    </p>
                </section>
                <section class="apartments-item-icon">
                    <figure>
                        <img width="100%" src="{{asset('img/icon.png')}}" alt="">
                    </figure>
                </section>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection
