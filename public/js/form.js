$(function(){
    if($('button.action').length > 0) {
        $('.action').on('click', function(){
console.log($(this).data('method'));
            switch($(this).data('method')){
                case 'post':
                    $('form').submit();
                    return false;
                    break;
                default:
                    return false;
                    break;
            }
        })
    }
});