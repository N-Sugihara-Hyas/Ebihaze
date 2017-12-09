@extends('layouts.traders_edit')

@section('content')
<div class="container">
    <div class="trader-detail">
        <section class="trader-detail__header">
            <div class="trader-detail__header--top">
                <figure class="trader-detail__mv">
                    <img class="c-circle" width="120px" height="120px" src="{{asset("img/resources/trader/$trader->id/icon")}}" alt="">
                </figure>
            </div>
            <div class="trader-detail__header--bottom">
                &nbsp;
            </div>
        </section>
        <table class="trader-detail__rank">
            <tr>
                <th class="c-star-unit"><span class="c-start-cell">{{($trader->rank < 1) ? '☆' : '★'}}</span></th>
                <th class="c-star-unit"><span class="c-start-cell">{{($trader->rank < 2) ? '☆' : '★'}}</span></th>
                <th class="c-star-unit"><span class="c-start-cell">{{($trader->rank < 3) ? '☆' : '★'}}</span></th>
                <th class="c-star-unit"><span class="c-start-cell">{{($trader->rank < 4) ? '☆' : '★'}}</span></th>
                <th class="c-star-unit"><span class="c-start-cell">{{($trader->rank < 5) ? '☆' : '★'}}</span></th>
            </tr>
            {{--<tr>--}}
                {{--<td>不満</td>--}}
                {{--<td></td>--}}
                {{--<td></td>--}}
                {{--<td></td>--}}
                {{--<td>満足</td>--}}
            {{--</tr>--}}
        </table>
        <h2 class="trader-detail__title">{{$trader->name}}</h2>
        <section class="trader-detail__body">
            <dl class="trader-detail__content">
                <dt class="trader-detail__address">住所</dt>
                <dd class="trader-detail__address">{{$trader->address}}</dd>
            </dl>
            <dl class="trader-detail__content">
                <dt class="trader-detail__tel">電話番号</dt>
                <dd class="trader-detail__tel">{{$trader->tel}}</dd>
            </dl>
            <dl class="trader-detail__content">
                <dt class="trader-detail__area">サービス提供エリア</dt>
                <dd class="trader-detail__area">{{$trader->area}}</dd>
            </dl>
            <dl class="trader-detail__content">
                <dt class="trader-detail__content">業務内容</dt>
                <dd class="trader-detail__content">{{$trader->introduction}}</dd>
            </dl>
            <dl class="trader-detail__content">
                <dt class="trader-detail__content">担当マンション</dt>
                <dd class="trader-detail__content">{{$apartment_names}}</dd>
            </dl>
        </section>
    </div>
</div>
@endsection
