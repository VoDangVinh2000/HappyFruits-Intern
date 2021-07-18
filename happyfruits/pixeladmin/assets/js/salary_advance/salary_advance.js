var table_name = 'salary_advances';
$(document).ready(function(){
    $('#datetimepicker').datetimepicker({
        locale: 'vn', 
        sideBySide: true,
        minDate: new Date($('#datetimepicker').attr('data-minDate')*1000),
        maxDate: new Date($('#datetimepicker').attr('data-maxDate')*1000),
        defaultDate: new Date($('#datetimepicker').attr('data-defaultDate')*1000),
        format: 'DD/MM/YYYY HH:mm'
    });
    $('#frmSalaryAdvance').submit(function(){
        if (!isValidForm('frmSalaryAdvance'))
            return false;
        var params = $(this).serialize();
        $("#frmSalaryAdvance #submit").attr('disabled', true);
        $("#frmSalaryAdvance #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmSalaryAdvance', data);
        },"json");
        return false; 
    });
});