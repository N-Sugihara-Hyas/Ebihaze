@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <ul class="users-list c-list">
        @foreach([0,1,2,3,4,5] as $list)
        <li class="users-list__item c-list__item">
            <div class="users-item-container">
                <section class="users-item-main">
                    <p class="users-item-batch c-btn c-btn--xsmall c-btn--blue">理事長</p>
                    <p class="users-item-title">
                        Yamamoto
                    </p>
                </section>
                <section class="users-item-icon">
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
