var table_name = 'debts';
$(document).ready(function(){
    addMoneyStringAlong('#amount', 'float: left; margin-left: 10px; margin-top: 7px;');
    addMoneyStringAlong('#paid_amount', 'float: left; margin-left: 10px; margin-top: 7px;');
    $('#datetimepicker').datetimepicker({
        locale: 'vn', 
        sideBySide: true,
        minDate: new Date($('#datetimepicker').attr('data-minDate')*1000),
        maxDate: new Date($('#datetimepicker').attr('data-maxDate')*1000),
        defaultDate: new Date($('#datetimepicker').attr('data-defaultDate')*1000),
        format: 'DD/MM/YYYY HH:mm'
    });
    $('#status').change(function(){
        if ($(this).val() == 'paid'){
            $('.paid').show();
        }else{
            $('.paid').hide();
        }
    });
    $('#status').trigger('change');
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