@extends('layouts.globalheader')

@section('content')
<div class="container">
    <div class="users-add_title">
        <p>
            マンション情報を編集してください。
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

    <form action="{{route('post.apartments-edit')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="apartment[id]" value="{{$apartment->id}}">
        <div class="users-add_form__container">
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-name">マンション名</dt>
                <dd class="users-add_list-form__apartment-name">
                    <input type="text" name="apartment[name]" value="{{$apartment->name}}">
                    {{--<button>検索</button>--}}
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-address">マンション住所入力</dt>
                <dd class="users-add_list-form__apartment-address">
                    <input type="text" name="apartment[address]" value="{{$apartment->address}}">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__user-reside">管理形態</dt>
                <dd class="users-add_list-form__user-reside">
                    <select name="apartment[control]" id="">
                        @foreach($apartment::$control as $ctrl)
                       <option value="{{$ctrl}}" {{($ctrl==$apartment->control) ? 'selected' : ''}}>{{$ctrl}}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-construction">構造</dt>
                <dd class="users-add_list-form__apartment-construction">
                    <select name="apartment[construction]" id="">
                        @foreach($apartment::$construction as $const)
                        <option value="{{$const}}" {{($const==$apartment->construction) ? 'selected' : ''}}>{{$const}}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-facilities">付帯設備</dt>
                <dd class="users-add_list-form__apartment-facilities">
                    @foreach($apartment::$facilities as $num => $fclt)
                    <label for="{{$num+1}}">
                        <input id="{{$num+1}}" type="checkbox" name="apartment[facilities][]" value="{{$fclt}}" {{(in_array($fclt, $apartment->facilities)) ? 'checked' : ''}}>
                        {{$fclt}}
                    </label>
                    @endforeach
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">保険情報</dt>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">■保険１</dt>
                <dd class="users-add_list-form__apartment-insurance">
                    <label for="">保険名<input type="text" value="{{$apartment->insurances_array[0]['name']}}" name="insurance[1][name]"></label>
                    <label for="">期日<input type="text" id="datepicker1" value="{{$apartment->insurances_array[0]['expired']}}" name="insurance[1][expired]"></label>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">■保険２</dt>
                <dd class="users-add_list-form__apartment-insurance">
                    <label for="">保険名<input type="text" value="{{$apartment->insurances_array[1]['name']}}" name="insurance[2][name]"></label>
                    <label for="">期日<input type="text" id="datepicker2" value="{{$apartment->insurances_array[1]['expired']}}" name="insurance[2][expired]"></label>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">■保険３</dt>
                <dd class="users-add_list-form__apartment-insurance">
                    <label for="">保険名<input type="text" value="{{$apartment->insurances_array[2]['name']}}" name="insurance[3][name]"></label>
                    <label for="">期日<input type="text" id="datepicker3" value="{{$apartment->insurances_array[2]['expired']}}" name="insurance[3][expired]"></label>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">■保険４</dt>
                <dd class="users-add_list-form__apartment-insurance">
                    <label for="">保険名<input type="text" value="{{$apartment->insurances_array[3]['name']}}" name="insurance[4][name]"></label>
                    <label for="">期日<input type="text" id="datepicker4" value="{{$apartment->insurances_array[3]['expired']}}" name="insurance[4][expired]"></label>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-insurance">■保険５</dt>
                <dd class="users-add_list-form__apartment-insurance">
                    <label for="">保険名<input type="text" value="{{$apartment->insurances_array[4]['name']}}" name="insurance[5][name]"></label>
                    <label for="">期日<input type="text" id="datepicker5" value="{{$apartment->insurances_array[4]['expired']}}" name="insurance[5][expired]"></label>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-completion_date">竣工年月</dt>
                <dd class="users-add_list-form__apartment-completion_date">
                    <select name="apartment[completion_date--year]" id="">
                        @foreach(range(date('Y', strtotime('-100 year')), date('Y')) as $year)
                            <option value="{{$year}}年" {{($year==preg_replace('/(.+)年/', '$1', $apartment->completion_date)) ? 'selected' : ''}}>{{$year}}</option>
                        @endforeach
                    </select>年
                    <select name="apartment[completion_date--month]" id="">
                        @foreach(range(1, 12) as $month)
                            <option value="{{$month}}月" {{($month==preg_replace('/.+年(.+)月/', '$1', $apartment->completion_date)) ? 'selected' : ''}}>{{$month}}</option>
                        @endforeach
                    </select>月
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-total_units">総戸数</dt>
                <dd class="users-add_list-form__apartment-total_units">
                    <input type="text" name="apartment[total_units]" value="{{$apartment->total_units}}">
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-introduction">マンション紹介テキスト(1,000文字まで)</dt>
                <dd class="users-add_list-form__apartment-introduction">
                    <textarea name="apartment[introduction]" id="" cols="30" rows="10">{{$apartment->introduction}}</textarea>
                </dd>
            </dl>
            <dl class="users-add_form__list">
                <dt class="users-add_list-title__apartment-facilities">マンション画像登録</dt>
                <dd class="users-add_list-form__apartment-facilities">
                    <figure>
                        <img src="{{asset("img/resources/apartment/$apartment->id/icon")}}" alt="未登録">
                    </figure>
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
@section('scripts')
<script>
    $(function() {
        $("#datepicker1").datepicker();
        $("#datepicker2").datepicker();
        $("#datepicker3").datepicker();
        $("#datepicker4").datepicker();
        $("#datepicker5").datepicker();
    });
</script>
@endsection
