@extends('layouts.globalheader')

@section('content')
<div class="container">
    <ul class="users-list c-list">
        @foreach($users as $user)
        <li class="users-list__item c-list__item">
            <div class="users-item-container">
                <section class="users-item-main">
                    @switch($user->type)
                        @case('officer')
                        <p class="users-item-batch c-btn c-btn--xsmall c-btn--skyblue">{{$user::$type_display[$user->type]}}</p>
                        @break
                        @case('app')
                        <p class="users-item-batch c-btn c-btn--xsmall c-btn--blue">{{$user::$type_display[$user->type]}}</p>
                        @break
                        @default
                        <p class="users-item-batch c-btn c-btn--xsmall c-btn--blue" style="visibility: hidden;">&nbsp;</p>
                        @break
                    @endswitch
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
