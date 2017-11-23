$(function(){
    if($('.action').length > 0) {
        $('.action').on('click', function(){
console.log($(this).data('method'));
            var $actioned = $(this);
            switch($(this).data('method')){
                case 'post':
                    if($('#required').length >= 1){
                        if($('#required').val()=='')return false;
                    }
                    $('form').submit();
                    return false;
                    break;
                case 'file':
                    $(this).parent().find('input[type="file"]').trigger('click');
console.log('click');
                    $(this).parent().find('input[type="file"]').on('change', function(){
                        var file = $(this).prop('files')[0];
                        //アイコンを選択中に変更
                        $actioned.addClass('c-btn--select').html('選択中');
                        //未選択→選択の場合（.filenameが存在しない場合）はファイル名表示用の<div>タグを追加
                        if(!($(this).parent().find('.filename').length)){
                            $actioned.parent().append('<div class="filename"></div>');
                        };
                        //ファイル名を表示
                        $(this).parent().find('.filename').html('ファイル名：' + file.name);
                    });
                    return false;
                    break;
                case 'file-comment':
                    $(this).parent().find('input[type="file"]').trigger('click');
                    $(this).parent().find('input[type="file"]').on('change', function(){
                        var file = $(this).prop('files')[0];
console.log(file);
                        //アイコンを選択中に変更
                        if(file===undefined){
                            $actioned.removeClass('c-btn--select').html('+');
                        }else{
                            $actioned.addClass('c-btn--select').html('-');
                        }
                        //未選択→選択の場合（.filenameが存在しない場合）はファイル名表示用の<div>タグを追加
                        // if(!($(this).parent().find('.filename').length)){
                        //     $actioned.parent().append('<div class="filename"></div>');
                        // };
                        //ファイル名を表示
                        // $(this).parent().find('.filename').html('ファイル名：' + file.name);
                    });
                    return false;
                    break;
                case 'switch':
                    var id = $(this).data('id');
                    $('form').append('<input type="hidden" name="apartment_id" value="'+id+'">').submit();
                    return false;
                    break;
                case 'link':
                    var href = $(this).data('href');
                    window.location.href = href;
                    return false;
                    break;
                default:
                    return false;
                    break;
            }
        })
    }
});