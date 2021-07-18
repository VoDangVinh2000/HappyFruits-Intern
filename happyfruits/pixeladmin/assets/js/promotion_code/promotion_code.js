var table_name = 'promotion_codes';
$(document).ready(function(){
    $('#start_date_picker').datetimepicker({
        locale: 'vn', 
        sideBySide: true,
        minDate: new Date($('#start_date_picker').attr('data-minDate')*1000),
        maxDate: new Date($('#start_date_picker').attr('data-maxDate')*1000),
        defaultDate: new Date($('#start_date_picker').attr('data-defaultDate')*1000),
        format: 'DD/MM/YYYY HH:mm'
    });
    $('#end_date_picker').datetimepicker({
        locale: 'vn', 
        sideBySide: true,
        minDate: new Date($('#end_date_picker').attr('data-minDate')*1000),
        maxDate: new Date($('#end_date_picker').attr('data-maxDate')*1000),
        defaultDate: new Date($('#end_date_picker').attr('data-defaultDate')*1000),
        format: 'DD/MM/YYYY HH:mm'
    });
    $('#frmPromotionCodes').submit(function(){
        if (!isValidForm('frmPromotionCodes'))
            return false;
        var params = $(this).serialize();
        $("#frmPromotionCodes #submit").attr('disabled', true);
        $("#frmPromotionCodes #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmPromotionCodes', data);
        },"json");
        return false; 
    });
    $('#generate_code').click(function(e){
        e.preventDefault();
        blockElement('#main-wrapper');
        $.post(postback_url, {action: 'admin_generate_promotion_code'}, function(data){
            unblockElement('#main-wrapper');
            if (data.status == 'OK'){
                $("#frmPromotionCodes #code").val(data.code);
                $("#frmPromotionCodes #code").focus();
            }
            else
                showAlertError(data.message);
        },"json");
    });
});