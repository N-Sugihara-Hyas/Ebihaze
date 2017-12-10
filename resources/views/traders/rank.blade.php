@extends('layouts.tradersheader')

@section('content')
<div class="container">
    <ul class="trader-list c-list">
        @foreach($traders as $num => $trader)
        <a href="{{route('traders-detail', $trader->id)}}">
            <li class="trader-list__item c-list__item">
                <div class="trader-item-container">
                    <section class="trader-item-num">
                        <p class="trader-item-batch">{{++$num}}</p>
                    </section>
                    <section class="trader-item-title-rank">
                        <p>
                            {{$trader->name}}
                        </p>
                    </section>
                    <section class="trader-item-rank">
                        <span class="trader-item-rank__fav">
                            ★
                        </span>
                        <span class="trader-item-rank__score">
                            {{round($trader->rank,1)}}
                        </span>
                    </section>
                    <section class="trader-item-icon">
                        <figure>
                            <img class="c-circle" width="41px" height="41px" src="{{asset("img/resources/trader/$trader->id/icon")}}" alt="">
                        </figure>
                    </section>
                </div>
            </li>
        </a>
        @endforeach
    </ul>
</div>
@endsection
