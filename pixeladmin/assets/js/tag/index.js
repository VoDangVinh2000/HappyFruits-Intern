var selected_product_ids = '';
$(document).ready(function(){
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%' // optional
    });
    $('#tag_icon').iconpicker({ 
        align: 'center', // Only in div tag
        arrowClass: 'btn-success',
        cols: 6,
        footer: true,
        header: true,
        icon: 'fa-heart',
        iconset: 'fontawesome', 
        search: true,
        searchText: 'Tìm icon',
        selectedClass: 'btn-success',
        unselectedClass: ''
    });
    $('#tag_icon_color').minicolors({
		control: 'hue',
		position: 'bottom left',
		theme: 'bootstrap',
        change: function(hex, opacity) {
            $('#tag_icon i').css('color', hex);
        }
	});
    $multiSeloctor = $("#products_list").select2({
		placeholder: "Vui lòng chọn sản phẩm thêm vào nhóm"
	});
    $multiSeloctor.on("change", function (e) {
        selected_product_ids = $(this).val();
    });
    $('#add_product_to_tag').click(function(){
        var tag_id = $('#tag_id').val();
        if (tag_id == ''){
            showAlertError('Vui lòng chọn hoặc thêm nhóm');
            return false;
        }
        if (selected_product_ids == ''){
            showAlertError('Vui lòng chọn sản phẩm muốn thêm vào nhóm');
            return false;
        }
        
        params = {
            action: 'admin_add_product_to_tag',
            tag_id: tag_id,
            product_ids: selected_product_ids
        };
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            unblockElement('#main-wrapper');
            if (data.status == 'OK'){
                if (data.products){
                    var item = '';
                    for(var index in data.products){
                        item = data.products[index];
                        $('#products-in-tag').append($('<li id="pit'+item.id+'">'+ item.category_name + ' - '+item.product_name+'<a id="del'+item.id+'" class="del"><i class="fa fa-trash"></i></a></li>'));
                    }
                    if (data.existed){
                        showNotifcation(data.existed);
                    }
                    $('#update_products_in_tag').show();
                    bindEvents();
                }else{
                    showAlertError('Có lỗi xảy ra. Không thể thêm sản phẩm vào nhóm.');
                }
            }else{
                showAlertError(data.message);
            }
        },"json");
        
        $multiSeloctor.val(null).trigger("change");
        selected_product_ids = '';
    });
    
    $('#add_tag_form').submit(function(){
        return false;
    })
    $('#add_tag').click(function(){
        var tag_name = $.trim($('#tag_name').val());
        if (tag_name == ''){
            showAlertError('Vui lòng nhập tên nhóm');
            return false;
        }
        var e_name = $.trim($('#english_name').val());
        if (e_name == ''){
            showAlertError('Vui lòng nhập tên tiếng Anh');
            return false;
        }
        params = {
            action: 'admin_update_tag',
            tag_id: $('#edit_tag_id').val(),
            tag_name: tag_name,
            english_name: e_name,
            tag_code: $.trim($('#tag_code').val()),
            icon: $('#tag_icon input[name="icon"]').val(),
            icon_color: $('#tag_icon_color').val(),
            image: $('#image').val(),
            description: $.trim($('#description').val()),
            is_main: $('#is_main').val()
        };
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            unblockElement('#main-wrapper');
            if (data.status == 'OK'){
                if (data.inserted_id){
                    $("#tag_id").append($('<option value="'+data.inserted_id+'">'+tag_name+'</option>'));
                    bindEvents();
                    document.getElementById("add_tag_form").reset();
                }else{
                    if (params['tag_id'] == '')
                        showAlertError('Không thể thêm nhóm, vui lòng thử lại sau');
                    else
                        showNotifcation('Thông tin nhóm đã được lưu.', 'success');
                }
            }else{
                showAlertError(data.message);
            }
        },"json");
    });
    $('#delete_tag').click(function(){
        showConfirmBox("Bạn có chắc muốn xóa nhóm này?", function(){
            params = {
                action: 'admin_delete',
                id: $('#edit_tag_id').val(),
                table_name: 'tags'
            };
            blockElement('#main-wrapper');
            $.post(postback_url, params, function(data){
                unblockElement('#main-wrapper');
                if (data.status == 'OK'){
                    window.location.reload();
                }else{
                    showAlertError(data.message);
                }
            },"json");
        },function(){
            /* Do nothing */
        });
    });
    $('#update_products_in_tag_btn').click(function(){
        var tag_id = $("#tag_id").val();
        var ids_in_list = [];
        $('#products-in-tag li').each(function(){
            ids_in_list.push($(this).attr('id').replace('pit',''));
        });
        params = {
            action: 'admin_update_products_in_tag',
            tag_id: tag_id,
            ids: ids_in_list
        };
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            unblockElement('#main-wrapper');
            if (data.status == 'OK'){
                showNotifcation('Danh sách đã được lưu.', 'success');
            }else{
                showAlertError(data.message);
            }
        },"json");
    });
    $('#edit_tag_id').change(function(){
        var tag_id = $(this).val();
        if (tag_id == '')
        {
            document.getElementById("add_tag_form").reset();
            $('#tag_icon').iconpicker('setIcon', 'fa-heart');
            setIconColor('#555555');
            $('#delete_tag').hide();
            return false;
        }
        params = {
            action: 'load_tag_details',
            tag_id: tag_id
        };
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            unblockElement('#main-wrapper');
            if (data.status == 'OK'){
                $('#tag_name').val(data.tag_name);
                $('#english_name').val(data.english_name);
                $('#tag_code').val(data.tag_code);
                if (data.icon)
                    $('#tag_icon').iconpicker('setIcon', data.icon);
                else
                    $('#tag_icon').iconpicker('setIcon', 'fa-heart');
                
                if (data.icon_color)
                    setIconColor(data.icon_color);
                else
                    setIconColor('#555555');
                if (data.image){
                    $('#image').val(data.image);
                    if (data.image.length)
                        $('#preview_image').html('<img src="'+data.image+'" height=100 />');
                    else
                        $('#preview_image').html('');
                }else{
                    $('#image').val('');
                    $('#preview_image').html('');
                }
                if (data.is_main == 1){
                    $('#is_main').iCheck('check');
                }else{
                    $('#is_main').iCheck('uncheck');
                }

                $('#description').val(data.description);
                $('#delete_tag').show();
            }else{
                showAlertError(data.message);
            }
        },"json");
    });
    bindEvents();
});

function setIconColor(color)
{
    $('#tag_icon_color').minicolors('value',color);
    $('#tag_icon i').css('color', color);
}

function loadProductsInTag()
{
    var tag_id = $("#tag_id").val();
    if (tag_id == '')
        return;    
    params = {
        action: 'search_product_in_tag',
        tag_id: tag_id
    };
    blockElement('#main-wrapper');
    $.post(postback_url, params, function(data){
        unblockElement('#main-wrapper');
        if (data.status == 'OK'){
            $('#products-in-tag').html('');
            if (data.products){
                var item = '';
                for(var index in data.products){
                    item = data.products[index];
                    $('#products-in-tag').append($('<li id="pit'+item.id+'">'+ item.category_name + ' - '+item.product_name+'<a id="del'+item.id+'" class="del"><i class="fa fa-trash"></i></a></li>'));
                }
                $('#products-in-tag-header').html('Danh sách sản phẩm trong nhóm');
                $('#update_products_in_tag').show();
                bindEvents();
            }else{
                $('#products-in-tag-header').html('Không có sản phẩm trong nhóm');
                $('#update_products_in_tag').hide();
                showNotifcation('Không có sản phẩm trong nhóm.');
            }
        }else{
            showAlertError(data.message);
        }
    },"json");
}

function bindEvents()
{
    //$("#products-in-tag").sortable( "destroy" );
    $("#products-in-tag").sortable();
    $("#products-in-tag").disableSelection();
    $('#products-in-tag a.del').click(function(e){
        e.preventDefault();
        $(this).parent().fadeOut(300, function(){ $(this).remove();});
    });
    $("#tag_id").unbind('change');
    $("#tag_id").change(function(){
        loadProductsInTag();
    });
}