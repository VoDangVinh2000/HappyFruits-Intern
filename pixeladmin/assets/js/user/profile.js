var table_name = 'users';
$(document).ready(function(){
    $('#frmUser').submit(function(){
        if (!isValidForm('frmUser'))
            return false;
        var params = $(this).serialize() + '&ajax=1';
        $("#frmUser #submit").attr('disabled', true);
        $("#frmUser #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            if (data.status == 'OK')
                window.location.href = base_url;
            else
            {
                $("#frmUser #submit").attr('disabled', false);
                $("#frmUser #submit span").text('Lưu');
                unblockElement('#main-wrapper');
                alert(data.message);
            }
        },"json");
        return false; 
    });
});