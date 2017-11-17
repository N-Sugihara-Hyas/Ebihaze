@extends('layouts.globalheader')

@section('content')
    <div class="container">
        <div class="trader-add_title">
            <p>
                業者を追加します
            </p>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('post.traders-add')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="trader-add_form__container">
                <dl class="trader-add_form__list">
                    <dt class="trader-add_list-title__trader-name">業者名</dt>
                    <dd class="trader-add_list-form__trader-name">
                        <input type="text" class="trader-add_input" name="trader[name]" value="{{old('trader.name')}}">
                    </dd>
                </dl>
                <dl class="trader-add_form__list">
                    <dt class="trader-add_list-title__trader-tel">電話番号</dt>
                    <dd class="trader-add_list-form__trader-tel">
                        <input type="text" class="trader-add_input" name="trader[tel]" value="{{old('trader.tel')}}">
                    </dd>
                </dl>
                <dl class="trader-add_form__list">
                    <dt class="trader-add_list-title__trader-address">住所</dt>
                    <dd class="trader-add_list-form__trader-address">
                        <input type="text" name="trader[address]" value="{{old('trader.address')}}">
                    </dd>
                </dl>
                <dl class="trader-add_form__list">
                    <dt class="trader-add_list-title__trader-area">サービス提供エリア</dt>
                    <dd class="trader-add_list-form__trader-area">
                        <input type="text" name="trader[area]" value="{{old('trader.area')}}">
                    </dd>
                </dl>
                <dl class="trader-add_form__list">
                    <dt class="trader-add_list-title__trader-introduction">業務内容</dt>
                    <dd class="trader-add_list-form__trader-introduction">
                        <textarea name="trader[introduction]" id="" cols="30" rows="10">{{old('trader.introduction')}}</textarea>
                    </dd>
                </dl>
                <dl class="trader-add_form__list">
                    <dt class="trader-add_list-title__trader-icon">業者画像登録</dt>
                    <dd class="trader-add_list-form__trader-icon" style="border-bottom: none;">
                        <button class="c-btn c-btn--large c-btn--blue action" data-method="file">画像登録</button>
                        <input type="file" name="trader_icon">
                    </dd>
                </dl>
                <div class="trader-add_form__submit">
                    <button class="c-btn c-btn--large c-btn--blue action" data-method="post">確認</button>
                </div>
            </div>
        </form>
    </div>
@endsection
