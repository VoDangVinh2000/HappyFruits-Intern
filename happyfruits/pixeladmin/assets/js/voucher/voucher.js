var table_name = 'vouchers';
$(document).ready(function(){
    $('#datetimepicker').datetimepicker({
        locale: 'vn', 
        sideBySide: true,
        minDate: new Date($('#datetimepicker').attr('data-minDate')*1000),
        maxDate: new Date($('#datetimepicker').attr('data-maxDate')*1000),
        defaultDate: new Date($('#datetimepicker').attr('data-defaultDate')*1000),
        format: 'DD/MM/YYYY HH:mm'
    });
    $('#frmVoucher').submit(function(){
        if (!isValidForm('frmVoucher'))
            return false;
        var params = $(this).serialize();
        $("#frmVoucher #submit").attr('disabled', true);
        $("#frmVoucher #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmVoucher', data);
        },"json");
        return false; 
    });
});