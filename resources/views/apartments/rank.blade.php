@extends('layouts.apartmentsheader')

@section('content')
<div class="container">
    <ul class="apartments-list c-list">
        @foreach($apartments as $num => $apart)
        <a href="{{route('apartments-detail', $apart->id)}}">
        <li class="apartments-list__item c-list__item">
            <div class="apartments-item-container">
                <section class="apartments-item-num">
                    <p class="apartments-item-batch">{{++$num}}</p>
                </section>
                <section class="apartments-item-main">
                    <p class="apartments-item-ranktitle">
                        {{$apart->name}}<br>
                        <span class="apartments-item-rank__fav">
                            ★
                        </span>
                            <span class="apartments-item-rank__score">
                                {{round($apart->rank, 1)}}
                        </span>
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
