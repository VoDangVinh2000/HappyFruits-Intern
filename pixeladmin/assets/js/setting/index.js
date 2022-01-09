var table_name = 'settings';
var current_image_index = 0;
var ckeditor_config = {
    toolbar: [
        { name: 'document', items: [ 'Source' ] },
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
        { name: 'insert', items: [ 'Image', 'Table', 'SpecialChar', 'Iframe' ] },
        '/',
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] }
    ],
    height :100
};
window.handleSelectedImage = function(imageUrl, imageID){
    $('#' + current_image_index).val(imageUrl);
    $('#' + current_image_index).trigger('change');
};
$(document).ready(function(){
    $('.datetime').datetimepicker({
        locale: 'vn',
        sideBySide: true,
        format: 'YYYY-MM-DD HH:mm'
    });
    bindNumber('.money');
    bindNumber('.int');
    bindFloat('.float');
    $('.money').addClass('normal');
    $('.money').each(function(){
        addMoneyStringAlong($(this), 'float: left; margin-left: 10px; margin-top: 7px;');
    });
    $('#frmSettings').submit(function(){
        if (!isValidForm('frmSettings'))
            return false;
        var params = $(this).serialize() + '&ajax=1';
        $("#frmSettings #submit").attr('disabled', true);
        $("#frmSettings #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmSettings', data);
        },"json");
        return false; 
    });

    $('.select_image').unbind('click');
    $('.select_image').click(function(e){
        e.preventDefault();
        current_image_index = $(this).attr('data-index');
        window.open(base_url + 'quan-ly-anh?type=select', '_blank', "toolbar=0,status=0,menubar=0,location=0,fullscreen=1,scrollbars=1");
    });

    $('.ckeditor').ckeditor(ckeditor_config);

    $('input.image-option').unbind('change');
    $('input.image-option').change(function(){
        var option_name = $(this).attr('id');
        var image_url = $(this).val();
        if (image_url.length)
            $('.preview_image.preview_' + option_name).html('<img src="'+image_url+'" height=100 />');
        else
            $('.preview_image.preview_' + option_name).html('');
    });
});