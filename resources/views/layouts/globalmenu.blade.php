<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>--}}
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" >
</head>
<body>
  <div id="app">
      <section id="modal-content-add">
          <div class="container" id="event-form">
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
                  <dl class="event-form">
                      <dt class="event-form__title">
                          施工日時
                      </dt>
                      <dd class="event-form__input">
                          <input type="text" name="schedule">
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
                          業者
                      </dt>
                      <dd class="event-form__input">
                          <input type="text" name="suppliers">
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
                          関係者
                      </dt>
                      <dd class="event-form__input">
                          <input type="text" name="parties">
                      </dd>
                  </dl>

                  <section class="c-btn-area">
                      <div class="c-btn-area__large">
                          <button class="c-btn c-btn--large c-btn--blue action" data-method="file">画像登録</button>
                          <input type="file" name="event_thumb">
                      </div>
                      <div class="c-btn-area__small" style="text-align: center">
                          <button class="c-btn c-btn--small c-btn--white action" style="width:115px;" data-method="cancel" id="modal-close-add">キャンセル</button>
                          <button class="c-btn c-btn--small c-btn--blue action" style="width:115px;" data-method="post">登録</button>
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
                        <a class="navbar-footer__tab navbar-footer--list navbar-footer__tab--active" href="{{route('events-list')}}">
                            <li>案件一覧</li>
                        </a>
                        <a class="navbar-footer__tab navbar-footer--join" href="{{route('events-join')}}">
                            <li>参加一覧</li>
                        </a>
                        <a class="navbar-footer__tab navbar-footer--watch" href="{{route('events-watch')}}">
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
                        <a class="navbar-footer__tab navbar-footer--join" href="{{route('apartments-rank')}}">
                            <li>
                                <img src="{{asset('img/nav_rank.png')}}" alt="ナビランク"><br>ランク
                            </li>
                        </a>
                        <a class="navbar-footer__tab navbar-footer--watch" href="{{route('events-watch')}}">
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
//            $("#datepicker").datepicker();
//            $('#datepicker_btn').on('click', function(){
//console.log('date_btn');
//                $('#datepicker').focus();
//                return false;
//            })
//            return false;
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
        });
    </script>
</body>
</html>
