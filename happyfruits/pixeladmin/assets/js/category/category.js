var table_name = 'categories';
$(document).ready(function(){
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%' // optional
    });
    $('#frmCategory').submit(function(){
        if (!isValidForm('frmCategory'))
            return false;
        var params = $(this).serialize() + '&ajax=1';
        $("#frmCategory #submit").attr('disabled', true);
        $("#frmCategory #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmCategory', data);
        },"json");
        return false; 
    });
    /* Conflict with jquery file uploader */
    $('#frmCategory').submit(function(){
        return false; 
    });
    
    /* Manage many images for a category - disable it temporary
    if ($('#category_id').val())
    {
        //Jquery File Uploader
        var url = postback_url,
            uploadButton = $('<button/>')
                .addClass('btn btn-primary')
                .prop('disabled', true)
                .text('Đang tải...')
                .on('click', function () {
                    var $this = $(this),
                        data = $this.data();
                    $this
                        .off('click')
                        .text('Hủy')
                        .on('click', function () {
                            $this.remove();
                            data.abort();
                        });
                    data.submit().always(function () {
                        $this.remove();
                    });
                    $('#progress .progress-bar').css('width', '0%');
                });
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            autoUpload: false,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            maxFileSize: 999000,
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
            previewMaxWidth: 100,
            previewMaxHeight: 100,
            previewCrop: true
        }).on('fileuploadadd', function (e, data) {
            data.context = $('<div/>').appendTo('#files');
            $.each(data.files, function (index, file) {
                var node = $('<p/>').append($('<span/>').text(file.name));
                if (!index) {
                    node.append('<br>').append(uploadButton.clone(true).data(data));
                }
                node.appendTo(data.context);
            });
            $('#progress .progress-bar').css('width', '0%');
            $('#progress').show();
        }).on('fileuploadprocessalways', function (e, data) {
            var index = data.index,
                file = data.files[index],
                node = $(data.context.children()[index]);
            if (file.preview) {
                node.prepend('<br>').prepend(file.preview);
            }
            if (file.error) {
                node.append('<br>').append($('<span class="text-danger"/>').text(file.error));
            }
            if (index + 1 === data.files.length) {
                data.context.find('button').text('Tải lên').prop('disabled', !!data.files.error);
            }
        }).on('fileuploadprogressall', function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css('width', progress + '%');
        }).on('fileuploaddone', function (e, data) {
            $.each(data.result.files, function (index, file) {
                if (file.url) {
                    var new_element = '<div class="thumbnail_container">' + 
                                        '<a class="delete_btn thumb_btn" href="#" id="'+file.image_id+'" title="Xóa"><i class="fa fa-trash"></i></a>' +
                                        '<a class="view_btn thumb_btn" href="'+file.url+'" target="_blank" title="Xem"><i class="fa fa-search"></i></a>' +
                                        '<img src="'+file.thumbnailUrl+'" />' +
                                        '</div>';
                    $('.product_images').append($(new_element));
                    bindDeleteImageBtn('.product_images .thumbnail_container .delete_btn');
                    $(data.context.children()[index]).remove();
                } else if (file.error) {
                    var error = $('<span class="text-danger"/>').text(file.error);
                    $(data.context.children()[index]).append('<br>').append(error);
                }
            });
        }).on('fileuploadfail', function (e, data) {
            $.each(data.files, function (index) {
                var error = $('<span class="text-danger"/>').text('Có lỗi xảy ra.');
                $(data.context.children()[index]).append('<br>').append(error);
            });
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
            
        bindDeleteImageBtn('.product_images .thumbnail_container .delete_btn');
    }
    */
});

function bindDeleteImageBtn(selector)
{
    $(selector).unbind('click');
    $(selector).click(function(e){
        e.preventDefault();
        if (!confirm('Ảnh sẽ bị xóa vĩnh viễn. Bạn có muốn tiếp tục?'))
            return;
        var self = $(this);
        var params = {};
        params['action'] = 'admin_update_category';
        params['action_type'] = 'remove_category_image';
        params['category_id'] = $('#category_id').val();
        params['image_id'] = self.attr('id');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            unblockElement('#main-wrapper');
            if (data.status == 'OK')
            {
                self.parent().remove();
            }
            else
            {
                alert(data.message);
            }
        },"json");
    });
}