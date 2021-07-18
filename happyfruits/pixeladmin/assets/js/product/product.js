var table_name = 'products';
var added_items = {};
var added_box_items = {};
$(document).ready(function(){
    $('input[type=checkbox]').not('.component_active,.component_important,.not-icheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%' // optional
    });
    $('#submit').click(function(){
        if (!isValidForm('frmProduct'))
            return false;
        var params = $('#frmProduct').serialize() + '&ajax=1';
        $('input[type=checkbox].component_active').each(function(){
            var val = 0;
            if($(this).is(':checked'))
                val = 1;
            params += '&item_active[]=' + val;
        });
        $('input[type=checkbox].component_important').each(function(){
            var val = 0;
            if($(this).is(':checked'))
                val = 1;
            params += '&item_important[]=' + val;
        });
        $("#frmProduct #submit").attr('disabled', true);
        $("#frmProduct #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            callbackSaveAction('frmProduct', data);
        },"json");
        return false; 
    });
    /* Conflict with jquery file uploader */
    $('#frmProduct').submit(function(){
        return false; 
    });
    
    $('#category_id').change(function(){
        // Multi-type Fruit
        if($(this).val() == 14){
            $('#type-container').removeClass('hidden');
        }else{
            $('#type-container').addClass('hidden');
        }
    });
    $('#category_id').trigger('change');

    $('.minicolors-input').minicolors({
        control: 'hue',
        position: 'bottom left',
        theme: 'bootstrap'
    });

    $('a.add_row').click(function(e){
        e.preventDefault();
        $("input.item_code").autocomplete('destroy');
        var record = $(this).parent().parent();
        var obj = record.clone(true);
        obj.find('input,select').val('');
        obj.find('.item_info').html('');
        var rand = Math.random();
        obj.find('input[id^="component_active_new"]').attr('id', 'component_active_new_' + rand);
        obj.find('label[for^="component_active_new"]').attr('for', 'component_active_new_' + rand);
        obj.find('input[id^="component_important_new"]').attr('id', 'component_important_new_' + rand);
        obj.find('label[for^="component_important_new"]').attr('for', 'component_important_new_' + rand);
        record.after(obj);
        $(this).addClass('hidden');
        $(this).next().removeClass('hidden');
        bindAutoComplete();
    });

    $('a.remove_row').click(function(e){
        e.preventDefault();
        var number_of_rows = $('#frmComponents #dataTables-components tbody tr').length;
        if (number_of_rows <= 1){
            alert('Thành phần món phải có ít nhất 1 dòng.');
            return;
        }
        if (confirm('Bạn có chắc muốn xóa dòng này?')){
            $(this).parent().parent().remove();
            var item_id = $(this).parent().find('input[name="item_id[]"]').val();
            if (typeof added_items[item_id] != 'undefined')
                delete added_items[item_id];
        }
    });

    $('input[name="item_id[]"]').each(function(){
        if($(this).val())
            added_items[$(this).val()] = 1;
    });

    $('a.add_box_item').click(function(e){
        e.preventDefault();
        $("input.box_item_code").autocomplete('destroy');
        var record = $(this).parent().parent();
        var obj = record.clone(true);
        obj.find('input,select').val('');
        obj.find('.box_item_info, .box_item_price, box_item_total').html('');
        record.after(obj);
        $(this).addClass('hidden');
        $(this).next().removeClass('hidden');
        bindAutoComplete();
    });

    $('a.remove_box_item').click(function(e){
        e.preventDefault();
        var number_of_rows = $('#frmProductsInBox #dataTables-components tbody tr').length;
        if (number_of_rows <= 1){
            alert('Phải có ít nhất 1 dòng.');
            return;
        }
        if (confirm('Bạn có chắc muốn xóa dòng này?')){
            $(this).parent().parent().remove();
            var box_item_id = $(this).parent().find('input[name="box_item_id[]"]').val();
            if (typeof added_box_items[box_item_id] != 'undefined')
                delete added_box_items[box_item_id];
        }
    });

    $('input[name="box_item_id[]"]').each(function(){
        if($(this).val())
            added_box_items[$(this).val()] = 1;
    });

    $('.product-type').change(function(){
        if($(this).is(':checked')){
            $('.product-type').not(this).prop('checked', false);
            if($(this).attr('id') == 'is_box'){
                $('.hide-if-box').addClass('hidden');
                $('.show-if-box').removeClass('hidden');
            }else{
                $('.hide-if-box').removeClass('hidden');
                $('.show-if-box').addClass('hidden');
            }
        }else{
            if($(this).attr('id') == 'is_box'){
                $('.hide-if-box').removeClass('hidden');
                $('.show-if-box').addClass('hidden');
            }
        }
    });
    $('.product-type:checked').trigger('change');

    if($('#products-in-box').length) {
        $('#box_discount_rate').change(function(){
            calBoxTotal();
        });
        calBoxTotal();
    }

    bindAutoComplete();
    
    /* Manage many images for a product - disable it temporary
    if ($('#product_id').val())
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
        params['action'] = 'admin_update_product';
        params['action_type'] = 'remove_product_image';
        params['product_id'] = $('#product_id').val();
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
                showAlertError(data.message);
            }
        },"json");
    });
}

function calBoxTotal()
{
    var subtotal = 0;
    $('.box_item_total').each(function(){
        if($(this).text().length)
            subtotal += parse_money($(this).text());
    });
    $('.box_subtotal').html(money_format(subtotal));
    var box_discount_rate = $('#box_discount_rate').val();
    $('.box_discount_rate').html(box_discount_rate);
    var discount_amount = subtotal*box_discount_rate/100;
    $('.box_discount_amount').html(money_format(discount_amount));
    total = subtotal - discount_amount;
    $('.box_total').html(money_format(total));
    $('#sell_price').val(total/1000);
    return total;
}


function bindAutoComplete()
{
    if($("input.item_code").length){
        $("input.item_code").autocomplete({
            minLength: 1,
            source: function(request, response) {
                var results = $.ui.autocomplete.filter(window.inventory_items, request.term);
                var counter = 0;
                var rs = [];
                for(var i = 0; i < results.length && counter < 10; i++){
                    if (typeof added_items[results[i].id] == 'undefined'){
                        rs.push(results[i]);
                        counter++;
                    }
                }
                response(rs);
            },
            select: function( event, ui ) {
                var row = $(this).parent().parent();
                //$(this).val(ui.item.value);
                $(row).find("#item_code").val(ui.item.code);
                $(row).find(".item_info").html(ui.item.name);
                $(row).find(".item_cat").html(ui.item.type_name.length?ui.item.type_name:'');
                $(row).find("#item_id").val(ui.item.id);
                $(row).find('.item_unit').html(ui.item.unit);
                added_items[ui.item.id] = 1;
                $(row).find('a.add_box_item').click();
                return false;
            }
        });
    }

    if($("input.box_item_code").length){
        $("input.box_item_code").autocomplete({
            minLength: 1,
            source: function(request, response) {
                var results = $.ui.autocomplete.filter(window.box_items, request.term);
                var counter = 0;
                var rs = [];
                for(var i = 0; i < results.length && counter < 10; i++){
                    if (typeof added_box_items[results[i].id] == 'undefined'){
                        rs.push(results[i]);
                        counter++;
                    }
                }
                response(rs);
            },
            select: function( event, ui ) {
                var row = $(this).parent().parent();
                $(this).val(ui.item.code);
                //$(row).find(".box_item_code").val(ui.item.code);
                $(row).find(".box_item_info").html(ui.item.name);
                $(row).find(".box_item_price").html(money_format(ui.item.price*1000));
                $(row).find(".box_item_discount_price").html(money_format((ui.item.price*(1-ui.item.box_discount_rate)*1000)));
                $(row).find(".box_item_id").val(ui.item.id);
                $(row).find('.box_item_amount').val(1);
                $(row).find('.box_item_amount').trigger('keyup');
                added_box_items[ui.item.id] = 1;
                $(row).find('a.add_box_item').click();
                return false;
            }
        });

        $("input.box_item_amount").unbind('keyup');
        $("input.box_item_amount").keyup(function(){
            var amount = parseFloat($(this).val());
            var record = $(this).parent().parent().parent();
            var price = parse_money(record.find('.box_item_price').text());
            record.find('.box_item_total').html(money_format(amount*price));
            calBoxTotal();
        });
    }
}