var current_element = selected_image_data = '';
$(document).ready(function(){
    if ($('body.superadmin').length){
        bindImageElement();
        $('#add_layout').click(function(e){
            e.preventDefault();
            $('#layout_listing').lightbox_me({
                closeEsc: false,
                modalCSS: {top: '80px'},
                overlayCSS: {background: 'black', opacity: .7},
                onLoad: function() {
                    
                }
            });
        });
        
        $('#image_listing .popup_content .thumbnail_container').click(function(e){
            e.preventDefault();
            $('.thumbnail_container').removeClass('selected');
            $(this).addClass('selected');
            var image_id = $(this).attr('id');
            if (images_data != {}){
                selected_image_data = images_data[image_id];
                $('#image_listing .popup_content .description .product_name').html(selected_image_data['product_name']);
                $('#image_listing .popup_content .description .product_price').html(selected_image_data['product_price'] + 'k');
                $('#image_listing .popup_content .description .product_description').html(selected_image_data['product_description']);
                $('#image_listing .popup_content .description').show();
                $('#image_listing .popup_content .buttons').show();
            }
        });
        
        $('#image_listing .popup_content button#back').click(function(e){
            $('#image_listing').trigger('close');
        });
        $('#image_listing .popup_content button#select').click(function(e){
            if (current_element.length == 0){
                $('#image_listing').trigger('close');
                alert('Vui lòng chọn khu vực cần hiển thị hình.');
            }else if(selected_image_data.length == 0){
                alert('Vui lòng chọn hình để thêm.');
            }else{
                var url = selected_image_data['small_image_url'] + '?r=' + Math.random();
                current_element.attr('id', selected_image_data['image_id']);
                current_element.html('');
                current_element.append($('<img class="product-image" src="'+url+'" />'));
                current_element.append($('#image_listing .popup_content .description').clone());
                $('#image_listing').trigger('close');
            }
        });
        $('#layout_listing .popup_content a.layout').click(function(e){
            e.preventDefault();
            var grid_type = $(this).attr('id');
            $('table.grid tbody').append($('table.template tbody .'+grid_type).clone());
            bindImageElement();
            $('#layout_listing').trigger('close');
        });
        
        $('#save_page').click(function(e){
            e.preventDefault();
            var self = $(this);
            var params = {};
            params['page_id'] = $('#page_id').val();
            params['action'] = 'admin_save_page';
            params['page_body'] = $('.page_body').html();
            $("#save_page").attr('disabled', true);
            $("#save_page span").text('Đang lưu...');
            blockElement('#main-wrapper');
            $.post(postback_url, params, function(data){
                $("#save_page").attr('disabled', false);
                $("#save_page span").text('Lưu');
                unblockElement('#main-wrapper');
                alert(data.message);
            },"json");
        });
    }
});

function bindImageElement()
{
    $('.image-element').unbind('click');
    $('.image-element').click(function(){
        current_element = $(this);
        $('#image_listing').lightbox_me({
            closeEsc: false,
            modalCSS: {top: '80px'},
            overlayCSS: {background: 'black', opacity: .7},
            onLoad: function() {
                
            }
        });
    });
}