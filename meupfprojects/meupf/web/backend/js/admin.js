jQuery(function($){
    $('.input.error input, .input.error textarea').focus(function(){
        $(this).parent().removeClass('error');
        $(this).parent().find('error-message').remove();
    })
});