var table_name = 'documents';
$(document).ready(function(){
    $('#frmDocument').submit(function(){
        if (!isValidForm('frmDocument'))
            return false;
        var params = $(this).serialize() + '&ajax=1';
        $("#frmDocument #submit").attr('disabled', true);
        $("#frmDocument #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmDocument', data);
        },"json");
        return false; 
    });
    $('#content').ckeditor();
    $('#name').change(function(){
        var code = $('#code').val();
        if (code.length == 0)
             $('#code').val(sanitize_string($(this).val()));
    });
});