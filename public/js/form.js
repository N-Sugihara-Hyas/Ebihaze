$(function(){
    if($('.action').length > 0) {
        $('.action').on('click', function(){
console.log($(this).data('method'));
            var $actioned = $(this);
            switch($(this).data('method')){
                case 'post':
                    $('form').submit();
                    return false;
                    break;
                case 'file':
                    $('input[type="file"]').trigger('click');
console.log('click');
                    $('input[type="file"]').on('change', function(){
                        var file = $(this).prop('files')[0];
                        //アイコンを選択中に変更
                        $actioned.addClass('c-btn--select').html('選択中');
                        //未選択→選択の場合（.filenameが存在しない場合）はファイル名表示用の<div>タグを追加
                        if(!($('.filename').length)){
                            $actioned.parent().append('<div class="filename"></div>');
                        };
                        //ファイル名を表示
                        $('.filename').html('ファイル名：' + file.name);
                    });
                    return false;
                    break;
                case 'switch':
                    var id = $(this).data('id');
                    $('form').append('<input type="hidden" name="apartment_id" value="'+id+'">').submit();
                    return false;
                    break;
                default:
                    return false;
                    break;
            }
        })
    }
});