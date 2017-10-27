@extends('layouts.globalmenu')

@section('content')
<div class="container">
    <div class="trader-detail">
        <section class="trader-detail__header">
            <div class="trader-detail__header--top">
                <figure class="trader-detail__mv">
                    <img width="120px" height="120px" src="{{asset('img/icon.png')}}" alt="">
                </figure>
            </div>
            <div class="trader-detail__header--bottom">
                &nbsp;
            </div>
        </section>
        <table class="trader-detail__rank">
            <tr>
                <th></th>
                <th>★</th>
                <th>★</th>
                <th>★</th>
                <th>★</th>
            </tr>
            <tr>
                <td>不満</td>
                <td></td>
                <td></td>
                <td></td>
                <td>満足</td>
            </tr>
        </table>
        <section class="trader-detail__body">
            <h2>{{$trader->name}}</h2>
            <dl class="trader-detail__content">
                <dt class="trader-detail__address">住所</dt>
                <dd class="trader-detail__address"></dd>
            </dl>
            <dl class="trader-detail__content">
                <dt class="trader-detail__tel">電話番号</dt>
                <dd class="trader-detail__tel"></dd>
            </dl>
            <dl class="trader-detail__content">
                <dt class="trader-detail__area">サービス提供エリア</dt>
                <dd class="trader-detail__area"></dd>
            </dl>
            <dl class="trader-detail__content">
                <dt class="trader-detail__content">業務内容</dt>
                <dd class="trader-detail__content"></dd>
            </dl>
        </section>
    </div>
</div>
@endsection
