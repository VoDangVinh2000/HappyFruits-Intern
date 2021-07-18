var table_name = 'shipping_fees';
var dataTableObj = '';
$(document).ready(function(){
    bindEvents();
    $('#add_fee').click(function(e){
       var district = $('#district').val();
       if(district == ''){
           $.growl.error({title: "Lỗi", message: "Vui lòng chọn quận." });
           return;
       }
        var min = $.trim($('#min').val());
        var fee = $.trim($('#fee').val());
        if(min == '' || fee == '' ){
            $.growl.error({title: "Lỗi", message: "Vui lòng nhận đủ thông tin." });
            return;
        }
        var params = {};
        params['action'] = 'admin_update_shipping_fees';
        params['type'] = 'add_district';
        params['district'] = district;
        params['min_total'] = min;
        params['fee'] = fee;
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            if (data.status == 'OK')
            {
                $.growl.notice({title: "Hoàn tất", message: "Phí giao hàng đã được thêm." });
                search();
            }
            else
            {
                unblockElement('#main-wrapper');
                alert(data.message);
            }
        },"json");
    });
});

function search(){
    var params = getParams('admin_search_shipping_fees');
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
    params['filter_district'] = $('.dataTables_filter #filter_district').val();
    return params;
}

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có thông tin.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-feeslist').dataTable({
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 3 ] }
            ],
            "columns": [
                { "orderDataType": "dom-text" },
                { "orderDataType": "dom-text" },
                { "orderDataType": "dom-text" },
                null
            ],
            "oLanguage": oLanguage
        });
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        bindEventForTableFilters('.dataTables_filter #filter_district');
    }

    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn dòng này?')){
            var id = $(this).parent().parent().attr('id');
            var params = {};
            params['action'] = 'admin_update_shipping_fees';
            params['type'] = 'delete_district';
            params['id'] = id;

            blockElement('#main-wrapper');
            $.post(postback_url, params, function(data){
                if (data.status == 'OK')
                {
                    $.growl.notice({title: "Hoàn tất", message: "Phí giao hàng đã được xóa." });
                    search();
                }
                else
                {
                    unblockElement('#main-wrapper');
                    alert(data.message);
                }
            },"json");
        }
    });
    bindNumber('.min_total, .fee');

    $('.min_total, .fee').unbind('change');
    $('.min_total, .fee').change(function(){
        var id = $(this).closest('tr').attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, id, field, new_value);
    });

    setLastColumnWidth();
}
