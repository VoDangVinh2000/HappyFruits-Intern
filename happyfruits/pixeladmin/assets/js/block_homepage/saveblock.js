$(document).ready(function(){
    $('#frmBlockHomePage').submit(function(){
        var params = $("#frmBlockHomePage").serialize() + '&ajax=1';
        $("#frmBlockHomePage #submit").attr('disabled', true);
        $("#frmBlockHomePage #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmBlockHomePage', data);
        },"json");
        return false; 
    });
});