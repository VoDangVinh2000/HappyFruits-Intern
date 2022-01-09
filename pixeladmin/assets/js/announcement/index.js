var table_name = 'announcements';
var dataTableObj = '';
$(document).ready(function(){
    var oLanguage = $.extend(true, {}, dataTables_oLanguage);
    oLanguage['sEmptyTable'] = 'Không có thông báo nào.';
    if (!dataTableObj){
        dataTableObj = $('#dataTables-announcementlist').dataTable({
          "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [ 3,4 ] }
           ],
           "columns": [
                { "orderDataType": "dom-text", type: 'string' },
               { "orderDataType": "dom-data-numeric" },
               { "orderDataType": "dom-data-numeric" },
                null,
                null
           ],
           "oLanguage": oLanguage,
           "order": [[ 2, "desc" ]]
        });
        
        dataTableObj.on( 'draw.dt', function () {
            bindEvents();
        } );
    }
    bindEvents();
});

function bindEvents()
{
    $('.name').change(function(){
        var id = $(this).parent().parent().attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).val();
        update(table_name, id, field, new_value);
    });

    $('.enabled').change(function(){
        var id = $(this).closest('tr').attr('id');
        var field = $(this).attr('class');
        var new_value = $(this).is(':checked')?1:0;
        update(table_name, id, field, new_value);
    });
    
    $('a.delete_item').unbind('click');
    $('a.delete_item').click(function(e){
        e.preventDefault();
        if (confirm('Bạn có chắc muốn xóa thông báo này?')){
            deleteById(table_name, $(this).parent().parent().attr('id'), URIs[table_name]);
        }
    });
    
    setLastColumnWidth();
}