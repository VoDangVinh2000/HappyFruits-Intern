var table_name = 'products';
var dataTableObj = '';
$(document).ready(function(){
    bindEvents();
});

function search(){
    var params = getParams('admin_search_product');
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
    params['filter_category'] = $('.dataTables_filter #filter_category').val();
    params['filter_type'] = $('.dataTables_filter #filter_type').val();
    return params;
}

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có hàng hóa nào.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-productlist').dataTable({
          "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [ 6, 7, 8 ] }
           ],
           "columns": [
                { "orderDataType": "dom-text-numeric" },
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-text-numeric" },
                null,
                null,
                null              
           ],
           aaSorting: [],
           "oLanguage": oLanguage
        });
        
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        
        bindFilterInput();
        bindEventForTableFilters('.dataTables_filter #filter_category, .dataTables_filter #filter_type');
    }
    
    $('.enabled, .is_hidden').change(function(){
        var category_id = $(this).closest('tr').attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).is(':checked')?1:0;
        update(table_name, category_id, field, new_value);
    });
    
    $('.name, .code, .sequence_number, .english_name, .promotion_price, .unit').change(function(){
        var category_id = $(this).parent().parent().attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, category_id, field, new_value);
    });
    
    bindFloat('.sequence_number,.promotion_price');
    
    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa hàng hóa này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });
    
    $('td.has_tooltip span').each(function(){
        if ($(this).html().indexOf('…') != -1){
            var contenthtml = $(this).next().html();
            $(this).parent().tooltipster({
                content: contenthtml,
                contentAsHTML: true,
                theme: 'tooltipster-shadow',
                position: 'bottom'
            });
        }
    });
    
    setLastColumnWidth();
}