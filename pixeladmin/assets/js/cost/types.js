var table_name = 'cost_types';
var dataTableObj = '';
var startDate = endDate = '';
$(document).ready(function(){
    bindEvents();
});

function getParams(action)
{
    var params = {};
    params['action'] = action;
    return params;
}

function bindEvents()
{
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có dữ liệu.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-mainlist').dataTable({
           "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [ 3 ] }
           ],
           "columns": [
                null,
                null,
                null,
                null
           ],
           "oLanguage": oLanguage,
           "order": [[ 1, "desc" ]]
        });
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
    }
    
    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa loại chi phí này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });

    $('.name').change(function(){
        var id = $(this).parent().parent().attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, id, field, new_value);
    });
    //setLastColumnWidth();
}