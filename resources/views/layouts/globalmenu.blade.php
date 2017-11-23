<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ebihaze') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
  <div id="app">
      <div id="modal-content-traders" style="z-index: 1004;">
          <ul class="trader-list c-list" id="trader-list">
              @foreach($traders as $trader)
                  <li class="trader-list__item c-list__item {{(in_array($trader->id, explode(',', old('suppliers')))) ? 'selected' : ''}}" data-id="{{$trader->id}}" data-name="{{$trader->name}}">
                      <div class="trader-item-container">
                          <section class="trader-item-title">
                              <p>
                                  {{$trader->name}}
                              </p>
                          </section>
                          <section class="trader-item-rank">
                <span class="trader-item-rank__fav">
                    ★
                </span>
                              <span class="trader-item-rank__score">
                    {{round($trader->rank,1)}}
                </span>
                          </section>
                          <section class="trader-item-icon">
                              <figure>
                                  <img class="c-circle" width="41px" height="41px" src="{{asset("img/resources/trader/$trader->id/icon")}}" alt="">
                              </figure>
                          </section>
                      </div>
                  </li>
              @endforeach
              <div class="c-btn-area__small" style="text-align: center">
                  <button class="c-btn c-btn--small c-btn--white action" style="width:44%;" data-method="cancel" id="modal-close-traders">キャンセル</button>
                  <button class="c-btn c-btn--small c-btn--blue" id="done-traders" style="width:44%;" data-method="post">OK</button>
              </div>
          </ul>
      </div>
      <div id="modal-content-users" style="z-index: 1004;">
          <ul class="users-list c-list" id="users-list">
              @foreach($users as $user)
                  <li class="users-list__item c-list__item {{(in_array($user->id, explode(',', old('parties')))) ? 'selected' : ''}}" data-id="{{$user->id}}" data-name="{{$user->nickname}}">
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
              <div class="c-btn-area__small" style="text-align: center">
                  <button class="c-btn c-btn--small c-btn--white" style="width:44%;" data-method="cancel" id="modal-close-users">キャンセル</button>
                  <button class="c-btn c-btn--small c-btn--blue" id="done-users" style="width:44%;" data-method="post">OK</button>
              </div>
          </ul>
      </div>
      <section id="modal-content-add">
          <div class="container modal-content-container" id="event-form">
              <h1>案件登録</h1>
              <form method="post" action="{{route('post.events-add')}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <dl class="event-form">
                      <dt class="event-form__title">
                          タイトル
                      </dt>
                      <dd class="event-form__input">
                          <input type="text" name="title">
                      </dd>
                  </dl>
                  <dl class="event-form" style="margin-bottom: 0;border-bottom:none;">
                      <dt class="event-form__title">
                          開始施工日時
                      </dt>
                  </dl>
                  <dl class="event-form">
                      <dd class="event-form__input">
                          <div style="display:inline-block;padding-left: 5px;width:60%;">
                              <small>日時：</small><br><input style="margin-left: 1em;width:75%;" type="text" name="schedule[Ymd]" id="datepicker1" value="{{old('schedule.Ymd')}}">
                          </div>
                          <div style="display:inline-block;width:35%;">
                              <small>時間：</small><br><select name="schedule[Hi]" id="datepicker">
                                  @foreach(range(0, 23) as $hour)
                                      @if(empty(old('schedule.Hi')) && $hour==12)
                                          <option value="{{sprintf("%02d", $hour)}}:00" selected>{{sprintf("%02d", $hour)}}:00</option>
                                          <option value="{{sprintf("%02d", $hour)}}:30">{{sprintf("%02d", $hour)}}:30</option>
                                      @else
                                          <option value="{{sprintf("%02d", $hour)}}:00" {{(old('schedule.Hi') == sprintf("%02d", $hour).":00") ? 'selected' : ''}}>{{sprintf("%02d", $hour)}}:00</option>
                                          <option value="{{sprintf("%02d", $hour)}}:30" {{(old('schedule.Hi') == sprintf("%02d", $hour).":30") ? 'selected' : ''}}>{{sprintf("%02d", $hour)}}:30</option>
                                      @endif
                                  @endforeach
                              </select>
                          </div>
                      </dd>
                  </dl>
                  <dl class="event-form" style="margin-bottom: 0;border-bottom:none;">
                      <dt class="event-form__title">
                          終了施工日時
                      </dt>
                  </dl>
                  <dl class="event-form">
                      <dd class="event-form__input">
                          <div style="display:inline-block;padding-left: 5px;width:60%;">
                              <small>日時：</small><br><input style="margin-left: 1em;width:75%;" type="text" name="schedule_end[Ymd]" id="datepicker2" value="{{old('schedule_end.Ymd')}}">
                          </div>
                          <div style="display:inline-block;width:35%;">
                              <small>時間：</small><br><select name="schedule_end[Hi]">
                                  @foreach(range(0, 23) as $hour)
                                      @if(empty(old('schedule_end.Hi')) && $hour==12)
                                          <option value="{{sprintf("%02d", $hour)}}:00" selected>{{sprintf("%02d", $hour)}}:00</option>
                                          <option value="{{sprintf("%02d", $hour)}}:30">{{sprintf("%02d", $hour)}}:30</option>
                                      @else
                                          <option value="{{sprintf("%02d", $hour)}}:00" {{(old('schedule_end.Hi') == sprintf("%02d", $hour).":00") ? 'selected' : ''}}>{{sprintf("%02d", $hour)}}:00</option>
                                          <option value="{{sprintf("%02d", $hour)}}:30" {{(old('schedule_end.Hi') == sprintf("%02d", $hour).":30") ? 'selected' : ''}}>{{sprintf("%02d", $hour)}}:30</option>
                                      @endif
                                  @endforeach
                              </select>
                          </div>
                      </dd>
                  </dl>
                  <dl class="event-form">
                      <dt class="event-form__title">
                          種類１
                      </dt>
                      <dd class="event-form__input">
                          <select name="category" id="category">
                              @foreach($main_category = array_keys($event::$category) as $cate)
                                  <option value="{{$cate}}">{{$cate}}</option>
                              @endforeach
                          </select>
                      </dd>
                  </dl>
                  <dl class="event-form">
                      <dt class="event-form__title">
                          種類２
                      </dt>
                      <dd class="event-form__input">
                          <select name="subcategory" id="subcategory">
                              @foreach($event::$category[$main_category[0]] as $subcate)
                                  <option value="{{$subcate}}">{{$subcate}}</option>
                              @endforeach
                          </select>
                      </dd>
                  </dl>
                  <dl class="event-form">
                      <dt class="event-form__title">
                          業者&nbsp;
                          <button style="width:auto;" class="c-btn c-btn--xsmall c-btn--skyblue" id="modal-open-traders">業者選択</button>
                      </dt>
                      <dd class="event-form__input">
                          <p class="suppliers_name" style="min-height: 24px;">{{old('suppliers_name')}}</p>
                          {{--<input type="text" name="suppliers_name" value="{{old('suppliers_name')}}">--}}
                          <input class="suppliers" type="hidden" name="suppliers" value="{{old('suppliers')}}">
                          <input class="suppliers_name" type="hidden" name="suppliers_name" value="{{old('suppliers_name')}}">
                      </dd>
                  </dl>
                  <dl class="event-form">
                      <dt class="event-form__title">
                          内容
                      </dt>
                      <dd class="event-form__input">
                          <input type="text" name="content">
                      </dd>
                  </dl>
                  <dl class="event-form">
                      <dt class="event-form__title">
                          関係者&nbsp;
                          <button style="width:auto;" class="c-btn c-btn--xsmall c-btn--skyblue" id="modal-open-users">関係者選択</button>
                      </dt>
                      <dd class="event-form__input">
                          <p class="parties" style="min-height: 24px;">{{old('parties_name')}}</p>
                          <input type="hidden" name="parties_name" value="{{old('parties_name')}}">
                          <input class="parties" type="hidden" name="parties" value="{{old('parties')}}">
                      </dd>
                  </dl>

                  <section class="c-btn-area">
                      <div class="c-btn-area__large">
                          <button class="c-btn c-btn--large c-btn--blue action" data-method="file">画像登録</button>
                          <input type="file" name="event_thumb">
                      </div>
                      <div class="c-btn-area__small" style="text-align: center">
                          <button class="c-btn c-btn--small c-btn--white action" style="width:44%;" data-method="cancel" id="modal-close-add">キャンセル</button>
                          <button class="c-btn c-btn--small c-btn--blue action" style="width:44%;" data-method="post">登録</button>
                      </div>
                  </section>

              </form>
          </div>
          <script>
              var category = {
                  '管理業務' : ['修繕', '清掃', '保険', '町内会等', 'その他'],
                  'イベント' : ['イベント'],
                  '会議' : ['理事会', '総会', 'その他'],
                  '共有' : ['連絡事項', 'その他'],
                  'その他' : ['その他']
              };
              $(function(){
                  $('#category').on('change', function(){
                      cate = $('#category').val();
                      subcate = category[cate];
                      $('#subcategory').empty();
                      $.each(subcate, function(){
                          $('#subcategory').append(
                                  '<option value="'+this+'">'+this+'</option>'
                          );
                      });
                  });
              });
          </script>
      </section>
      <section id="modal-content-cal">
      </section>
      <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-left" href="{{ route('events-add') }}" id="modal-open-add">
                        ＋<br>
                        <small>登録</small>
                    </a>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{$title}}
                    </a>
                    <a class="navbar-right" href="{{route('events-search') }}" id="modal-open-cal">
                        <img src="{{asset('img/nav_flag.png')}}" alt="カレンダー"><br>
                        <small>カレンダー</small>
                    </a>
                </div>
                <div class="navbar-footer">
                    <ul class="navbar-footer__list">
                        <a class="navbar-footer__tab navbar-footer--list {{(preg_match('/list/',url()->current())) ? 'navbar-footer__tab--active' : ''}}" href="{{route('events-list')}}">
                            <li>案件一覧</li>
                        </a>
                        <a class="navbar-footer__tab navbar-footer--join {{(preg_match('/join/',url()->current())) ? 'navbar-footer__tab--active' : ''}}" href="{{route('events-join')}}">
                            <li>参加一覧</li>
                        </a>
                        <a class="navbar-footer__tab navbar-footer--watch {{(preg_match('/watch/',url()->current())) ? 'navbar-footer__tab--active' : ''}}" href="{{route('events-watch')}}">
                            <li>ウォッチ一覧</li>
                        </a>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="container">
            @yield('content')
        </div>

        <nav class="navbar navbar-default navbar-static-bottom">
            <div class="container">
                <div class="navbar-footer">
                    <ul class="navbar-footer__list">
                        <a class="navbar-footer__tab navbar-footer--list" href="{{route('statics-menu')}}">
                            <li>
                                <img src="{{asset('img/nav_menu.png')}}" alt="ナビメニュー"><br>メニュー
                            </li>
                        </a>
                        <a class="navbar-footer__tab navbar-footer--list" href="{{route('events-list')}}">
                            <li>
                                <img src="" alt="(画像アイコン)"><br>案件一覧
                            </li>
                        </a>
                        @if(Auth::user()->type=='officer'||Auth::user()->type=='app')
                        <a class="navbar-footer__tab navbar-footer--join" href="{{route('apartments-rank')}}">
                            <li>
                                <img src="{{asset('img/nav_rank.png')}}" alt="ナビランク"><br>ランク
                            </li>
                        </a>
                        @endif
                        <a class="navbar-footer__tab navbar-footer--watch" href="{{route('flyers-list')}}">
                            <li>
                                <img src="{{asset('img/nav_flyer.png')}}" alt="ナビチラシ"><br>チラシ
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Scripts -->
    @section('scripts')
    @show
    <script src="{{ asset('js/form.js') }}"></script>
    <script src="{{ asset('js/calender.js') }}"></script>
{{--    <script src="{{ asset('js/app.js') }}"></script>--}}
    <script>
        $(function() {
            $("#datepicker1").datepicker();
            $("#datepicker2").datepicker();
        });
    </script>
    <script>
        function setEvent(){
console.log('setEvent trig');
            var event_days = @json($calendar);
            var year = $('table.calendar thead th').text().replace(/(.+)年.+/, '$1');
console.log(year);
            var month = ('0'+$('table.calendar thead th').text().replace(/.+年(.+)月/, '$1')).slice(-2);
console.log(month);
            var preg = new RegExp(year+'-'+month);
            var target_days = $.grep(event_days, function(elem, index){
                return (elem.match(preg));
            });

            $('table.calendar tbody td').each(function(){
                if($(this).text().match(/\d/)){
console.log($(this).text())
                    var day = ('0'+$(this).text()).slice(-2);
                    $(this).html('<a class="'+year+'-'+month+'-'+day+'">'+$(this).text()+'</a>');
                }
            });
            $('table.calendar tbody td a').each(function(){
                if($.inArray($(this).attr('class'), target_days)!=-1){
                    $(this).css({
                        'display' : 'inline-block',
                        'width' : '60%',
                        'background' : 'orange',
                        'border-radius' : '20px',
                        'border' : 'solid 1px orange'
                    });
                    var url = "{{route('events-list')}}";
                    $(this).attr('href', url+'?schedule='+$(this).attr('class'));
                }
            });
        }
        $(function(){
            // イベント登録
            $("#modal-open-add").click(function(t){
                t.preventDefault();
                $(this).blur() ; //ボタンからフォーカスを外す
                if($("#modal-overlay")[0]) return false ; //新しくモーダルウィンドウを起動しない
                //オーバーレイ用のHTMLコードを、[body]内の最後に生成する
                $("#container").append('<div id="modal-overlay"></div>');
                //[$modal-overlay]をフェードインさせる
                $("#modal-overlay").fadeIn("slow");
                $("#modal-content-add").fadeIn("slow");
                $('#container').css({'overflow': 'hidden'});
                $("#modal-overlay,#modal-close,#modal-close-add").unbind().click(function(t){
                    t.preventDefault();
                    //[#modal-overlay]と[#modal-close]をフェードアウトする
                    $("#modal-content-add,#modal-overlay").fadeOut("slow",function(){
                        //フェードアウト後、[#modal-overlay]をHTML(DOM)上から削除
                        $("#modal-overlay").remove();
                    });
                    $('#container').css({'overflow': 'visible'});
                });
            });
            // カレンダー表示
            $('#modal-open-cal').click(function(t){
                t.preventDefault();
                $(this).blur() ;	//ボタンからフォーカスを外す
                var ve = document.getElementById('modal-content-cal');
                var calendar = new Calendar(ve);
                calendar.view(); // 表示

                // イベント日付設定
                setEvent();
                $(document).unbind().on('click', 'table.calendar thead .next, table.calendar thead .prev',  function(){
                    setEvent();
                });

                if($("#modal-overlay")[0]) return false ; //新しくモーダルウィンドウを起動しない
                //オーバーレイ用のHTMLコードを、[body]内の最後に生成する
                $("#container").append('<div id="modal-overlay"></div>');
                $("#modal-overlay").fadeIn("slow");
                $("#modal-content-cal").fadeIn("slow");
                $('#container').css({'overflow': 'hidden'});
                $("#modal-overlay,#modal-close,#modal-close-cal").unbind().click(function(t){
                    t.preventDefault();
                    //[#modal-overlay]と[#modal-close]をフェードアウトする
                    $("#modal-content-cal,#modal-overlay").fadeOut("slow",function(){
                        //フェードアウト後、[#modal-overlay]をHTML(DOM)上から削除
                        $("#modal-overlay").remove();
                    });
                    $('#container').css({'overflow': 'visible'});
                });
            });
        });
    </script>
  <script>
      $(function() {
          // イベント登録
          $("#modal-open-traders").click(function (t) {
              t.preventDefault();
              $(this).blur(); //ボタンからフォーカスを外す
              if ($("#modal-overlay-inner")[0]) return false; //新しくモーダルウィンドウを起動しない
              //オーバーレイ用のHTMLコードを、[body]内の最後に生成する
              $("#container").append('<div id="modal-overlay-inner"></div>');
              //[$modal-overlay-inner]をフェードインさせる
              $("#modal-overlay-inner").fadeIn("slow");
              $("#modal-content-traders").fadeIn("slow");
              $('#container').css({'overflow': 'hidden'});
              $("#modal-overlay-inner,#modal-close,#modal-close-traders").unbind().click(function (t) {
                  t.preventDefault();
                  //[#modal-overlay-inner]と[#modal-close]をフェードアウトする
                  $("#modal-content-traders,#modal-overlay-inner").fadeOut("slow", function () {
                      //フェードアウト後、[#modal-overlay-inner]をHTML(DOM)上から削除
                      $("#modal-overlay-inner").remove();
                  });
                  $('#container').css({'overflow': 'visible'});
              });
          });
          // 業者選択
          $('#trader-list li').on('click', function(){
              if($(this).hasClass('selected')){
                  $(this).removeClass('selected');
              }else{
                  $(this).addClass('selected');
              }
          });
          $('#done-traders').on('click', function(t){
              t.preventDefault();
              var ids = [];
              var names = [];
              $('#trader-list .selected').each(function(){
                  ids.push($(this).data('id'));
                  names.push($(this).data('name'));
              });
              var id = ids.join();
              var name = names.join();
              $('input[name=suppliers]').val(id);
              $('input[name=suppliers_name]').val(name);
              $('p.suppliers_name').text(name);
              $('#modal-close-traders').trigger('click');
          });
          // 関係者選択
          $("#modal-open-users").click(function (t) {
              t.preventDefault();
              $(this).blur(); //ボタンからフォーカスを外す
              if ($("#modal-overlay-inner")[0]) return false; //新しくモーダルウィンドウを起動しない
              //オーバーレイ用のHTMLコードを、[body]内の最後に生成する
              $("#container").append('<div id="modal-overlay-inner"></div>');
              //[$modal-overlay-inner]をフェードインさせる
              $("#modal-overlay-inner").fadeIn("slow");
              $("#modal-content-users").fadeIn("slow");
              $('#container').css({'overflow': 'hidden'});
              $("#modal-overlay-inner,#modal-close,#modal-close-users").unbind().click(function (t) {
                  t.preventDefault();
                  //[#modal-overlay-inner]と[#modal-close]をフェードアウトする
                  $("#modal-content-users,#modal-overlay-inner").fadeOut("slow", function () {
                      //フェードアウト後、[#modal-overlay-inner]をHTML(DOM)上から削除
                      $("#modal-overlay-inner").remove();
                  });
                  $('#container').css({'overflow': 'visible'});
              });
          });
          $('#users-list li').on('click', function(){
              if($(this).hasClass('selected')){
                  $(this).removeClass('selected');
              }else{
                  $(this).addClass('selected');
              }
          });
          $('#done-users').on('click', function(t){
              t.preventDefault();
              var ids = [];
              var names = [];
              $('#users-list .selected').each(function(){
                  ids.push($(this).data('id'));
                  names.push($(this).data('name'));
              });
              var id = ids.join();
              var name = names.join();
              $('input[name=parties]').val(id);
              $('input[name=parties_name]').val(name);
              $('p.parties').text(name);
              $('#modal-close-users').trigger('click');
          });
      });
  </script>
</body>
</html>
