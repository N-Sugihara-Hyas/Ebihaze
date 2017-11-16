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
    {{--<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" >--}}
</head>
<body>
  <div id="app">
        <div id="container">
            @yield('content')
        </div>

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
