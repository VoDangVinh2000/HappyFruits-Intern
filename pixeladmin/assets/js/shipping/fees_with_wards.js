var table_name = 'shipping_fees_with_ward';
var dataTableObj = '';
$(document).ready(function(){
    bindEvents();
    $('#add_ward_form').submit(function(){
        var self = $(this);
        var valid = 1;
        self.find('input[name]').each(function(){
            if ($(this).val() == '' && valid){
                valid = 0;
                alert('Vui lòng nhập đầy đủ thông tin.');
                return;
            }
        });
        if (!valid)
            return false;
        var params = {};
        params['action'] = 'admin_update_shipping_fees_with_ward';
        params['type'] = 'update_ward';
        params['id'] = $('.dataTables_filter #filter_type').val();
        params['district'] = $('.dataTables_filter #filter_district').val();
        params['ward_name'] = self.find('input[name="ward_name"]').val();
        params['ward_min'] = self.find('input[name="ward_min"]').val();
        params['ward_fee'] = self.find('input[name="ward_fee"]').val();
        params['ward_free_ship'] = self.find('input[name="ward_free_ship"]').val();
        
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            unblockElement('#main-wrapper');
            if (data.status == 'OK')
            {
                $.growl.notice({title: "Hoàn tất", message: "Phí giao hàng đã được lưu." });
                $('#list_container').html(data.html);
                dataTableObj = '';
                bindEvents();
                $("input[name]").val("");
            }
            else
            {
                alert(data.message);
            }
        },"json");
        return false;
    });
});


function search(){
    var params = getParams('admin_search_shipping_fees_with_wards');
    if (params['filter_district'] == '')
        return;    
    blockElement('#main-wrapper');
    $.post(postback_url, params, function(data){
        unblockElement('#main-wrapper');
        if (data.status == 'OK')
        {
            if (data.html){
                $('#list_container').html(data.html);
                dataTableObj = '';
                bindEvents();
            }
        }
        else
        {
            alert(data.message);
        }
    },"json");
}

function getParams(action)
{
    var params = {};
    params['action'] = action;
    params['filter_type'] = $('.dataTables_filter #filter_type').val();
    params['filter_district'] = $('.dataTables_filter #filter_district').val();
    return params;
}

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có thông tin phường. Phí giao sẽ áp dụng theo quận.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-feeslist').dataTable({
           "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [ 4 ] }
           ],
           "columns": [
                { "orderDataType": "dom-text" },
                { "orderDataType": "dom-text" },
                { "orderDataType": "dom-text" },
                { "orderDataType": "dom-text" },
                null
           ],
           "oLanguage": oLanguage,
           aaSorting: []
        });
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        bindEventForTableFilters('.dataTables_filter #filter_type');
        
        $('.dataTables_filter #filter_district').unbind('change');
        $('.dataTables_filter #filter_district').change(function(){
            var id = $(this).attr('id');
            var value = $(this).val();
            if (value != ''){
                $('.add_ward_form_container').show();
                $('.for_datatable_filter #' + id + ' option').removeAttr('selected');
                $('.for_datatable_filter #' + id + ' option[value="' + value + '"]').attr('selected', '');
                search();
            }else{
                $('.add_ward_form_container').hide();
            }
        });
        $('.shipping_fees_for_district input#min').val($('#district_min').val());
        $('.shipping_fees_for_district input#fee').val($('#district_fee').val());
        $('.shipping_fees_for_district input#free_ship').val($('#district_free_ship').val());
    }
    
    $('.shipping_fees_for_district input#min, .shipping_fees_for_district input#fee, .shipping_fees_for_district input#free_ship').unbind('change');
    $('.shipping_fees_for_district input#min, .shipping_fees_for_district input#fee, .shipping_fees_for_district input#free_ship').change(function(){
        var id = $(this).attr('id');
        var params = {};
        params['action'] = 'admin_update_shipping_fees_with_wards';
        params['type'] = 'update_district_' + id;
        params['id'] = $('.dataTables_filter #filter_type').val();
        params['district'] = $('.dataTables_filter #filter_district').val();
        params['value'] = $(this).val();
        
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            unblockElement('#main-wrapper');
            if (data.status == 'OK')
            {
                $.growl.notice({title: "Hoàn tất", message: "Phí giao hàng đã được lưu." });
            }
            else
            {
                alert(data.message);
            }
        },"json");
    });

    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn dòng này?')){
            var ward_name = $(this).parent().parent().attr('id');
            var params = {};
            params['action'] = 'admin_update_shipping_fees_with_wards';
            params['type'] = 'delete_ward';
            params['id'] = $('.dataTables_filter #filter_type').val();
            params['district'] = $('.dataTables_filter #filter_district').val();
            params['ward_name'] = ward_name;
            
            blockElement('#main-wrapper');
            $.post(postback_url, params, function(data){
                unblockElement('#main-wrapper');
                if (data.status == 'OK')
                {
                    $.growl.notice({title: "Hoàn tất", message: "Phí giao hàng đã được xóa." });
                }
                else
                {
                    alert(data.message);
                }
            },"json");
        }
    });
    
    $('#dataTables-feeslist td input[class^="ward_"]').change(function(){
        var row = $(this).parent().parent();
        var params = {};
        params['action'] = 'admin_update_shipping_fees_with_wards';
        params['type'] = 'update_ward';
        params['id'] = $('.dataTables_filter #filter_type').val();
        params['district'] = $('.dataTables_filter #filter_district').val();
        params['ward_name'] = row.attr('id');
        params['ward_min'] = row.find('.ward_min').val();
        params['ward_fee'] = row.find('.ward_fee').val();
        params['ward_free_ship'] = row.find('.ward_free_ship').val();
        
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            unblockElement('#main-wrapper');
            if (data.status == 'OK')
            {
                $.growl.notice({title: "Hoàn tất", message: "Phí giao hàng đã được lưu." });
            }
            else
            {
                alert(data.message);
            }
        },"json");
    });
    
    setLastColumnWidth();
}
