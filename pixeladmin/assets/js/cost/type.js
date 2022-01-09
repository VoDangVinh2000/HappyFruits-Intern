var table_name = 'cost_types';
$(document).ready(function(){
    $('#frmMain').submit(function(){
        if (!isValidForm('frmMain'))
            return false;
        var params = $(this).serialize();
        $("#frmMain #submit").attr('disabled', true);
        $("#frmMain #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmMain', data);
        },"json");
        return false; 
    });
});