var table_name = 'inventory_item_details';
$(document).ready(function(){
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%' // optional
    });
    bindOnlyCharacter('#code');
    $('#frmItem').submit(function(){
        if (!isValidForm('frmItem'))
            return false;
        var params = $(this).serialize() + '&ajax=1';
        $("#frmItem #submit").attr('disabled', true);
        $("#frmItem #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            if (data.status == 'OK')
                if ($('#is_fruit').val() == 1){
                    window.location.href = base_url + URIs['inventory_item_fruits'];
                }else{
                    window.location.href = base_url + URIs['inventory_item'];
                }
            else
            {
                $("#frmItem #submit").attr('disabled', false);
                $("#frmItem #submit span").text('Lưu');
                unblockElement('#main-wrapper');
                alert(data.message);
            }
        },"json");
        return false; 
    });
});