@extends('layouts.globalheader')

@section('content')
<div class="container">
    <div class="users-add_title">
        <p>
            マンション情報を入力してください。
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

    <form action="{{route('post.apartments-add')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="users-add_form__container">
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-name">マンション名</dt>
                <dd class="users-add_list-form__apartment-name">
                    <input type="text" name="apartment[name]" value="{{old('apartment.name')}}">
                    {{--<button>検索</button>--}}
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-address">マンション住所入力</dt>
                <dd class="users-add_list-form__apartment-address">
                    <input type="text" name="apartment[address]" value="{{old('apartment.address')}}">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-reside">管理形態</dt>
                <dd class="users-add_list-form__user-reside">
                    <select name="apartment[control]" id="">
                        @foreach($apartment::$control as $ctrl)
                       <option value="{{$ctrl}}" {{($ctrl==old('apartment.control')) ? 'selected' : ''}}>{{$ctrl}}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-construction">構造</dt>
                <dd class="users-add_list-form__apartment-construction">
                    <select name="apartment[construction]" id="">
                        @foreach($apartment::$construction as $const)
                        <option value="{{$const}}" {{($const==old('apartment.construction')) ? 'selected' : ''}}>{{$const}}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-facilities">付帯設備</dt>
                <dd class="users-add_list-form__apartment-facilities">
                    @foreach($apartment::$facilities as $num => $fclt)
                    <label for="{{$num+1}}">
                        @if(!is_null(old('apartment.facilities')))
                        <input id="{{$num+1}}" type="checkbox" name="apartment[facilities][]" value="{{$fclt}}" {{(in_array($fclt, old('apartment.facilities'))) ? 'checked' : ''}}>
                        @else
                        <input id="{{$num+1}}" type="checkbox" name="apartment[facilities][]" value="{{$fclt}}">
                        @endif
                        {{$fclt}}
                    </label>
                    @endforeach
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">保険情報</dt>
                <dd class="users-add_list-form__apartment-insurance">
                    <input type="checkbox" name="apartment[insurance][]">
                    <input type="checkbox" name="apartment[insurance][]">
                    <input type="checkbox" name="apartment[insurance][]">
                    <input type="checkbox" name="apartment[insurance][]">
                    <input type="checkbox" name="apartment[insurance][]">
                    <input type="checkbox" name="apartment[insurance][]">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-completion_date">竣工年月</dt>
                <dd class="users-add_list-form__apartment-completion_date">
                    <input type="text" name="apartment[completion_date]" value="{{old('apartment.completion_date')}}">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-total_units">総戸数</dt>
                <dd class="users-add_list-form__apartment-total_units">
                    <input type="text" name="apartment[total_units]" value="{{old('apartment.total_units')}}">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-introduction">マンション紹介テキスト(1,000文字まで)</dt>
                <dd class="users-add_list-form__apartment-introduction">
                    <textarea name="apartment[introduction]" id="" cols="30" rows="10">{{old('apartment.introduction')}}</textarea>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-facilities">マンション画像登録</dt>
                <dd class="users-add_list-form__apartment-facilities">
                    <button class="c-btn c-btn--large c-btn--blue action" data-method="file">画像登録</button>
                    <input type="file" name="apartment_icon">
                </dd>
            </dl>
            <div class="users-add_form__submit">
                <button class="c-btn c-btn--large c-btn--blue action" data-method="post">登録</button>
            </div>
        </div>
    </form>
</div>
@endsection
