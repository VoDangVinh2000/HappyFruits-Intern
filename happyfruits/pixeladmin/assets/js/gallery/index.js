var selected_image_ids = '';
window.handleSelectedImage = function(imageUrl, imageID){
    if (selected_image_ids.length)
        selected_image_ids.push(imageID);
    else
        selected_image_ids = [imageID];
    addImagesToGallery();
}
$(document).ready(function(){
    $multiSeloctor = $("#images_list").select2({
		placeholder: "Vui lòng chọn ảnh thêm vào thư viện"
	});
    $multiSeloctor.on("change", function (e) {
        selected_image_ids = $(this).val();
    });
    
    $('#select_image').click(function(e){
        e.preventDefault();
        window.open(base_url + 'quan-ly-anh?type=select', '_blank', "toolbar=0,status=0,menubar=0,location=0,fullscreen=0,scrollbars=1");
    });
    
    $('#add_image_to_gallery').click(function(){
        if (selected_image_ids == ''){
            showAlertError('Vui lòng chọn ảnh muốn thêm vào thư viện');
            return false;
        }
        addImagesToGallery();
    });
    
    $('#update_images_in_gallery_btn').click(function(){
        var ids_in_list = [];
        $('#images-in-gallery li').each(function(){
            ids_in_list.push($(this).attr('id').replace('pit',''));
        });
        params = {
            action: 'admin_update_images_in_gallery',
            ids: ids_in_list
        };
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            unblockElement('#main-wrapper');
            if (data.status == 'OK'){
                showNotifcation('Thư viện đã được lưu.', 'success');
            }else{
                showAlertError(data.message);
            }
        },"json");
    });
    bindEvents();
});

function addImagesToGallery()
{
    var params = {
        action: 'admin_add_image_to_gallery',
        image_ids: selected_image_ids
    };
    blockElement('#main-wrapper');
    $.post(postback_url, params, function(data){
        unblockElement('#main-wrapper');
        if (data.status == 'OK'){
            if (data.images){
                var item = '';
                for(var index in data.images){
                    item = data.images[index];
                    $('#images-in-gallery').append($('<li id="pit'+item.id+'"><img src="'+item.path+'" />'+ item.filename +'<a id="del'+item.id+'" class="del"><i class="fa fa-trash"></i></a></li>'));
                }
                if (data.existed){
                    showNotifcation(data.existed);
                }
                $('#update_images_in_gallery').show();
                bindEvents();
            }else{
                showAlertError('Có lỗi xảy ra. Không thể thêm ảnh vào thư viện.');
            }
        }else{
            showAlertError(data.message);
        }
    },"json");
    
    $multiSeloctor.val(null).trigger("change");
    selected_image_ids = '';
}

function bindEvents()
{
    $("#images-in-gallery").sortable();
    $("#images-in-gallery").disableSelection();
    $('#images-in-gallery a.del').click(function(e){
        e.preventDefault();
        $(this).parent().fadeOut(300, function(){ $(this).remove();});
    });
}