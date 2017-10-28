@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <ul class="users-list c-list">
        @foreach($users as $user)
        <li class="users-list__item c-list__item">
            <div class="users-item-container">
                <section class="users-item-main">
                    <p class="users-item-batch c-btn c-btn--xsmall c-btn--blue">{{$user->type}}</p>
                    <p class="users-item-title">
                        {{$user->nickname}}
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
