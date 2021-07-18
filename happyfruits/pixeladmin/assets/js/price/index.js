var table_name = 'prices';
var dataTableObj = '';
$(document).ready(function(){
    bindEvents();
});

function search(){
    var params = getParams('admin_search_price');
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
    return params;
}

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có hàng hóa nào.';
    if (!dataTableObj){
        var numbers_of_col = $('#dataTables-pricelist thead tr th').length;
        aTargets = [];
        columns = [
            { "orderDataType": "dom-text", type: 'string' },
            { "orderDataType": "dom-text", type: 'string' }
        ];
        if (numbers_of_col > 2){
            for(var i = 3; i < numbers_of_col; i++){
                aTargets.push(i);
                columns.push(null);
            }
        }
        dataTableObj = $('#dataTables-pricelist').dataTable({
          "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': aTargets }
           ],
           "columns": columns,
           aaSorting: [],
           "oLanguage": oLanguage
        });
        
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
        
        bindFilterInput();
        bindEventForTableFilters('.dataTables_filter #filter_category');
    }

    $('td input.price').unbind('change');
    $('td input.price').change(function(){
        update(table_name, $(this).attr('id'), 'price', $(this).val());
    });
    
    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa dòng dữ liệu này?')){
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