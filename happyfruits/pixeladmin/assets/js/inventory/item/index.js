var table_name = 'inventory_item_details';
var dataTableObj = '';
$(document).ready(function(){
    bindEvents();
});

function search(){
    var params = getParams('admin_search_inventory_item');
    blockElement('#main-wrapper');
    $.post(postback_url, params, function(data){
        unblockElement('#main-wrapper');
        if (data.status == 'OK')
        {
            $('#list_container').html(data.html);
            dataTableObj = '';
            bindEvents();
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
    params['filter_type_id'] = $('.dataTables_filter #filter_type_id').val();
    params['filter_warehouse_id'] = $('.dataTables_filter #filter_warehouse_id').val();
    params['is_fruit'] = $('#is_fruit').val();
    return params;
}

function bindEvents()
{
    if (!dataTableObj){
        var oLanguage = $.extend(true, {}, dataTables_oLanguage);
        oLanguage['sEmptyTable'] = 'Không có hàng hóa kho nào.';
        dataTableObj = $('#dataTables-itemlist').dataTable({
            "bSort": false,
            "oLanguage": oLanguage,
            "pageLength": 20
        });
        
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
    }

    bindFilterInput();
    bindEventForTableFilters('.dataTables_filter #filter_type_id, .dataTables_filter #filter_warehouse_id');
    
    $('.name, .unit, .default_price, .warning_quanity, .required_quantity').change(function(){
        var category_id = $(this).parent().parent().attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, category_id, field, new_value);
    });

    bindFloat('.default_price, .warning_quanity, .required_quantity');
    
    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa hàng hóa này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs['inventory_item']);
        }
    });

    setLastColumnWidth();
}