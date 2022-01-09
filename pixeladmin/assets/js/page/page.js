var table_name = 'pages';
var current_image_index = 0;
var ckeditor_config = {
    toolbar: [
        { name: 'document', items: [ 'Source' ] },
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
        '/',
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] }
    ],
    height :100
};
window.handleSelectedImage = function(imageUrl, imageID){
    $('.slide'+current_image_index+'-container input[name="slide_image[]"]').val(imageUrl);
    $('.slide'+current_image_index+'-container input[name="slide_image[]"]').trigger('change');
};
$(document).ready(function(){
    $('input[type=checkbox]').not('.not-icheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%' // optional
    });
    $('#submit').click(function(e){
        e.preventDefault();
        if (!isValidForm('frmPage'))
            return false;
        var params = $('#frmPage').serialize() + '&ajax=1';
        $("#frmPage #submit").attr('disabled', true);
        $("#frmPage #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            $('select.select2').select2('close');
            callbackSaveAction('frmPage', data);
        },"json");

        return false; 
    });
    $('#page_body').ckeditor();
    $('.ckeditor').ckeditor(ckeditor_config);
    $('#page_title').change(function(){
        var page_code = $('#page_code').val();
        if (page_code.length == 0)
             $('#page_code').val(sanitize_string($(this).val()));
    });
    $('#page_template').change(function(){
        $('.hide-by-default').addClass('hidden');
        switch($(this).val()){
            case 'template-home.php':
                $('.for-home-template').removeClass('hidden');
                $('select.select2').select2();
                break;
            case 'template-category.php':
                $('.for-category-template').removeClass('hidden');
                $('select.select2').select2();
                break;
            case 'template-page.php':
                $('.for-page-template').removeClass('hidden');
                break;
        }
    });
    $('#page_template').trigger('change');
    bindEvents();
});

function bindEvents()
{
    $('.select_image').unbind('click');
    $('.select_image').click(function(e){
        e.preventDefault();
        current_image_index = $(this).attr('data-index');
        window.open(base_url + 'quan-ly-anh?type=select', '_blank', "toolbar=0,status=0,menubar=0,location=0,fullscreen=1,scrollbars=1");
    });

    $('input[name="slide_image[]"]').unbind('change');
    $('input[name="slide_image[]"]').change(function(){
        var index = $(this).attr('id').replace('slide_image', '');
        var image_url = $(this).val();
        if (image_url.length)
            $('.slide'+index+'-container .preview_header_image').html('<img src="'+image_url+'" height=100 />');
        else
            $('.slide'+index+'-container .preview_header_image').html('');

        if(index == $('.preview_header_image').length-2){
            var new_index = parseInt(index) + 1;
            var $clone = $('.slide-container-template').clone();
            $clone.removeClass('slide-container-template');
            var html = $clone.html();
            html = html.replace(/LABEL/g, new_index+1);
            html = html.replace(/INDEX/g, new_index);
            $clone.addClass('slide' + new_index + '-container')
            $clone.html(html);
            $clone.attr('style', '');
            $('.slides-container').append($clone);
            $('.slides-container').append('<div class="clear"></div>');
            $('#slide_content_'+new_index).ckeditor(ckeditor_config);
            bindEvents();
        }
    });
}