var table_name = 'inventory';
var dataTableObj = '';
$(document).ready(function(){
    bindEvents();
});

function getParams(action)
{
    var params = {};
    params['action'] = action;
    params['filter_warehouse'] = $('.dataTables_filter #filter_warehouse').val();
    params['filter_type_id'] = $('.dataTables_filter #filter_type_id').val();
    params['is_fruit'] = $('#is_fruit').val();
    return params;
}

function search(){
    var params = getParams('admin_search_inventory');
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

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có hàng hóa nào.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-inventorylist').dataTable({
           "oLanguage": oLanguage,
            "pageLength": 50,
            "order": [[ 4, "desc" ]]
        });
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        bindEventForTableFilters('.dataTables_filter #filter_warehouse, .dataTables_filter #filter_type_id');
    }
    setLastColumnWidth();
}