@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <ul class="trader-list c-list">
        @foreach([0,1,2,3,4,5] as $list)
        <li class="trader-list__item c-list__item">
            <div class="trader-item-container">
                <section class="trader-item-title">
                    <p>
                        山本ビル管理サービス
                    </p>
                </section>
                <section class="trader-item-rank">
                    <span class="trader-item-rank__fav">
                        ★
                    </span>
                    <span class="trader-item-rank__score">
                        4.3
                    </span>
                </section>
                <section class="trader-item-icon">
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
