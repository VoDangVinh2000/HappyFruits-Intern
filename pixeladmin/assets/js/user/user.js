var table_name = 'users';
$(document).ready(function(){
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%' // optional
    });
    $('#frmUser').submit(function(){
        if (!isValidForm('frmUser'))
            return false;
        var params = $(this).serialize() + '&ajax=1';
        $("#frmUser #submit").attr('disabled', true);
        $("#frmUser #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmUser', data);
        },"json");
        return false; 
    });

    $('input[name="need_deposit"]').on('ifChecked', function(event){
        $('.hours_deposit_container').removeClass('hidden');
    });
    $('input[name="need_deposit"]').on('ifUnchecked', function(event){
        $('.hours_deposit_container').addClass('hidden');
    });

    $('#description').ckeditor();
});