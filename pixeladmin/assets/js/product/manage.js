var table_name = 'inventory_item_details';
var dataTableObj = '';
$(document).ready(function(){
    bindEvents();
});

function search(){
    var params = getParams('admin_search_inventory_item_for_quick_management');
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
    params['is_fruit'] = $('#is_fruit').val();
    return params;
}

function bindEvents()
{
    if (!dataTableObj){
        var oLanguage = $.extend(true, {}, dataTables_oLanguage);
        oLanguage['sEmptyTable'] = 'Không có hàng hóa nào.';
        dataTableObj = $('#dataTables-itemlist').dataTable({
            "oLanguage": oLanguage,
            "pageLength": 20,
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 2, 3 ] }
            ],
            aaSorting: [[0,'asc']]
        });
        
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
    }

    bindFilterInput();
    bindEventForTableFilters('.dataTables_filter #filter_type_id');

    $('.out_of_stock').change(function(){
        var parameters = {};
        parameters['action'] = 'admin_update_out_of_stock';
        parameters['id'] = $(this).closest('tr').attr('id');
        parameters['value'] = $(this).is(':checked')?1:0;
        blockElement('#main-wrapper');
        $.post(postback_url, parameters, function(data){
            unblockElement('#main-wrapper');
            if (data.status != 'OK')
                showAlertError(data.message);
        },"json");
    });

    setLastColumnWidth();
}