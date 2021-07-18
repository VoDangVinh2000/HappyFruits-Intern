var table_name = 'shipping_details';
var dataTableObj = '';
$(document).ready(function(){
    bindEvents();
});

function getParams(action)
{
    var params = {};
    params['action'] = action;
    params['filter_month'] = $('.dataTables_filter #filter_month').val();
    params['filter_year'] = $('.dataTables_filter #filter_year').val();
    if ($('.dataTables_filter #filter_member').length)
        params['filter_member'] = $('.dataTables_filter #filter_member').val();
    else
        params['filter_member'] = $('#filter_member').val();
    return params;
}

function search(){
    var params = getParams('admin_search_shipping');
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
    oLanguage['sEmptyTable'] = 'Không có thông tin giao hàng nào.';
    if (!dataTableObj){
        var numbers_of_col = $('#dataTables-shippinglist thead tr th').length;
        if (numbers_of_col == 7)
            var oColumns = [
                null,
                null,
                null,
                { "orderDataType": "dom-data-numeric" },
                { "orderDataType": "dom-text-numeric" },
                { "orderDataType": "dom-text-numeric" },
                null
           ];
        else
            var oColumns = [
                null,
                null,
                null,
                null,
                null,
                null
           ];
        dataTableObj = $('#dataTables-shippinglist').dataTable({
          "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [ numbers_of_col-1 ] }
           ],
           "columns": oColumns,
           "oLanguage": oLanguage,
           aaSorting: [],
        });
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        
        bindFilterInput();
        bindEventForTableFilters('.dataTables_filter #filter_month, .dataTables_filter #filter_year, .dataTables_filter #filter_member');
        
        if ($('#number_of_records').length){
            $('.dataTables_filter span.number_of_records').html($('#number_of_records').val());
            $('.dataTables_filter span.shipping_total').html($('#shipping_total').val());
        }
    }
    
    $('.dataTables_filter #filter_search').click(function(){
        blockElement('#main-wrapper');
        window.location.href = base_url + 'giao-hang/tim/' + $('.dataTables_filter #filter_keyword').val();
    });
    
    $('.dataTables_filter #filter_back').click(function(){
        blockElement('#main-wrapper');
        window.location.href = base_url + 'giao-hang';
    });
    
    $('.dataTables_filter #show_previous_month').click(function(){
          
    });
    
    $('.number_of_dishes, .total, .distance').change(function(){
        var id = $(this).parent().parent().attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, id, field, new_value);
    });
    
    bindNumber('.number_of_dishes, .total');
    bindFloat('.distance');
    
    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa thông tin giao hàng này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });
    
    setLastColumnWidth();
}