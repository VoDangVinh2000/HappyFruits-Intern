var table_name = 'pages';
var dataTableObj = '';
$(document).ready(function(){
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có trang nào.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-pagelist').dataTable({
          "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [ 4 ] }
           ],
           "columns": [
                { "orderDataType": "dom-text", type: 'string' },
                { "orderDataType": "dom-text", type: 'string' },
                null,
                { "orderDataType": "dom-data-numeric" },
                null
           ],
           "oLanguage": oLanguage,
           "order": [[ 1, "asc" ]]
        });
        
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
    }
    bindEvents();
});

function bindEvents()
{
    $('.page_code, .page_title').change(function(){
        var id = $(this).parent().parent().attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, id, field, new_value);
    });
    
    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa trang này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });
    
    setLastColumnWidth();
}