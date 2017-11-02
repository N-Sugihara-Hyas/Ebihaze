@extends('layouts.apartments_edit')

@section('content')
<div class="container">
    <div class="apartments-detail">
        <section class="apartments-detail__header">
            <div class="apartments-detail__header--top">
                <figure class="apartments-detail__mv">
                    <img width="120px" height="120px" src="{{asset('img/resources/apartment/'.$apartment->id.'/icon')}}" alt="アパート登録画像">
                </figure>
            </div>
            <div class="apartments-detail__header--bottom">
                &nbsp;
            </div>
        </section>
        <table class="apartments-detail__rank">
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
        <h2 class="apartments-detail__title">{{$apartment->name}}</h2>
        <section class="apartments-detail__body">
            <dl class="apartments-detail__content">
                <dt class="apartments-detail__address"></dt>
                <dd class="apartments-detail__address">{{$apartment->address}}</dd>
            </dl>
            <dl class="apartments-detail__content">
                <dt class="apartments-detail__address">竣工</dt>
                <dd class="apartments-detail__address">{{$apartment->completion_date}}</dd>
            </dl>
            <dl class="apartments-detail__content">
                <dt class="apartments-detail__address">管理形態</dt>
                <dd class="apartments-detail__address">{{$apartment->control}}</dd>
            </dl>
            <dl class="apartments-detail__content">
                <dt class="apartments-detail__address">構造</dt>
                <dd class="apartments-detail__address">{{$apartment->construction}}</dd>
            </dl>
            <dl class="apartments-detail__content">
                <dt class="apartments-detail__address">総戸数</dt>
                <dd class="apartments-detail__address">{{$apartment->total_units}}</dd>
            </dl>
            <dl class="apartments-detail__content">
                <dt class="apartments-detail__content"></dt>
                <dd class="apartments-detail__content">{{$apartment->introduction}}</dd>
            </dl>
        </section>
    </div>
</div>
@endsection
