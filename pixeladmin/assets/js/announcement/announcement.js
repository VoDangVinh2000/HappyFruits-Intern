var table_name = 'announcements';
var image_type = '';
window.handleSelectedImage = function(imageUrl, imageID){
    if(image_type == 'promotion'){
        $('#promotion_image').val(imageUrl);
        $('#promotion_image').trigger('change');
    }else{
        $('#image').val(imageUrl);
        $('#image').trigger('change');
    }
    image_type = '';
}
$(document).ready(function(){
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%' // optional
    });
    $('#start_dtm,#end_dtm').datepicker({language: 'vn', autoclose: true});
    $('#start_time').timepicker({
        template: false,
        showInputs: false,
        minuteStep: 5,
        showMeridian: false,
        defaultTime: '0:00'
    });
    $('#end_time').timepicker({
        template: false,
        showInputs: false,
        minuteStep: 5,
        showMeridian: false,
        defaultTime: '23:59'
    });
    $('#start_sales_time').timepicker({
        template: false,
        showInputs: false,
        minuteStep: 5,
        showMeridian: false,
        defaultTime: '0:00'
    });
    $('#end_sales_time').timepicker({
        template: false,
        showInputs: false,
        minuteStep: 5,
        showMeridian: false,
        defaultTime: '23:59'
    });
    $('#temporary_close').on('ifClicked', function(event){
        if ($(this).is(':checked')){
        }else{
            $('#has_sales_time').iCheck('uncheck');
            $('#is_promotion').iCheck('uncheck');
            $('.sales-time-container').hide();
            $('.promotion-image-container').hide();
        }
    });
    $('#has_sales_time').on('ifClicked', function(event){
        if ($(this).is(':checked')){
            $('.sales-time-container').hide();
        }else{
            $('#temporary_close').iCheck('uncheck');
            $('.sales-time-container').show();
        }
    });
    $('#is_promotion').on('ifClicked', function(event){
        if ($(this).is(':checked')){
            $('.promotion-image-container').hide();
        }else{
            $('#temporary_close').iCheck('uncheck');
            $('.promotion-image-container').show();
        }
    });
    $('#frmAnnouncement').submit(function(){
        if (!isValidForm('frmAnnouncement'))
            return false;
        var params = $(this).serialize() + '&ajax=1';
        $("#frmAnnouncement #submit").attr('disabled', true);
        $("#frmAnnouncement #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmAnnouncement', data);
        },"json");
        return false; 
    });
    $('#content, #content_en').ckeditor();

    $('#select_promotion_image').click(function(e){
        e.preventDefault();
        image_type = 'promotion';
        window.open(base_url + 'quan-ly-anh?type=select', '_blank', "toolbar=0,status=0,menubar=0,location=0,fullscreen=1,scrollbars=1");
    });

    $('#promotion_image').change(function(){
        var image_url = $(this).val();
        if (image_url.length)
            $('#preview_promotion_image').html('<img src="'+image_url+'" height=100 />');
        else
            $('#preview_promotion_image').html('');
    });
    $('#promotion_image').trigger('change');
});